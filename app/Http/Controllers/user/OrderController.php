<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->get();
        return view('user.orders', compact('orders'));
    }

    public function checkout(Request $request)
    {
        $selectedIds = $request->input('selected', []);
        if (empty($selectedIds)) {
            return back()->with('error', 'Bạn chưa chọn sản phẩm nào để thanh toán.');
        }

        $items = Cart::whereIn('id', $selectedIds)
            ->where('user_id', Auth::id())
            ->with('product')->get();

        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'order_code' => time(),
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'total_price' => $total,
            'status' => 'pending'
        ]);

        foreach ($items as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price
            ]);
        }

        return $this->payWithMomo($order);
    }

    private function payWithMomo(Order $order)
    {
        $endpoint    = env('MOMO_ENDPOINT');
        $partnerCode = env('MOMO_PARTNER_CODE');
        $accessKey   = env('MOMO_ACCESS_KEY');
        $secretKey   = env('MOMO_SECRET_KEY');

        $orderInfo   = "Thanh toán đơn hàng #{$order->order_code}";
        $redirectUrl = route('momo.callback');
        $ipnUrl      = route('momo.callback');
        $extraData   = "";

        $rawHash = "accessKey=$accessKey&amount={$order->total_amount}&extraData=$extraData&ipnUrl=$ipnUrl&orderId={$order->order_code}&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId={$order->order_code}&requestType=captureWallet";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            'storeId' => "MomoTestStore",
            'requestId' => $order->order_code,
            'amount' => $order->total_amount,
            'orderId' => $order->order_code,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => 'captureWallet',
            'signature' => $signature
        ];

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        curl_close($ch);

        $jsonResult = json_decode($result, true);
        return redirect($jsonResult['payUrl']);
    }

    public function momoCallback(Request $request)
    {
        $partnerCode = env('MOMO_PARTNER_CODE');
        $accessKey = env('MOMO_ACCESS_KEY');
        $secretKey = env('MOMO_SECRET_KEY');

        $rawHash = "accessKey=$accessKey&amount={$request->amount}&extraData={$request->extraData}&message={$request->message}&orderId={$request->orderId}&orderInfo={$request->orderInfo}&orderType={$request->orderType}&partnerCode=$partnerCode&payType={$request->payType}&requestId={$request->requestId}&responseTime={$request->responseTime}&resultCode={$request->resultCode}&transId={$request->transId}";
        $checkSignature = hash_hmac("sha256", $rawHash, $secretKey);

        if ($checkSignature === $request->signature) {
            $order = Order::where('order_code', $request->orderId)->first();
            if ($order) {
                if ($request->resultCode == 0) {
                    $order->status = 'paid';
                    $order->save();

                    Cart::where('user_id', $order->user_id)
                        ->whereIn('product_id', $order->items->pluck('product_id'))
                        ->delete();

                    return redirect()->route('orders.my')
                        ->with('success', 'Thanh toán thành công!');
                } else {
                    $order->status = 'failed';
                    $order->save();
                    return redirect()->route('orders.my')->with('error', 'Thanh toán thất bại!');
                }
            }
        }
        return "Chữ ký không hợp lệ!";
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('orders.my', compact('orders'));
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);

        if ($order->status === 'pending') {
            $order->status = 'cancelled';
            $order->save();
            return back()->with('success', 'Đơn hàng đã hủy.');
        }
        return back()->with('error', 'Không thể hủy đơn này.');
    }

    public function payAgain(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);

        if ($order->status === 'pending') {
            return $this->payWithMomo($order);
        }
        return back()->with('error', 'Đơn này không thể thanh toán lại.');
    }
}
