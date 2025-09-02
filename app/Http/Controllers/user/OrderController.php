<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

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
            ->with('product')
            ->get();

        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        // Tùy bạn xử lý tiếp: tạo đơn hàng, chuyển trang xác nhận, v.v.
        return view('checkout.summary', compact('items', 'total'));
    }
}
