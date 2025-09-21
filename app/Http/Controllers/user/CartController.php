<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product.category')
            ->where('user_id', Auth::id())
            ->get();

        $total = 0;

        foreach ($cartItems as $item) {
            $price = $item->product->price;

            // Nếu có giảm giá thì tính giá sau giảm
            if (!empty($item->product->discount) && $item->product->discount > 0) {
                $price = $price * (1 - $item->product->discount / 100);
            }

            $total += $price * $item->quantity;
        }

        return view('user.cart', compact('cartItems', 'total'));
    }

    public function store(Product $product, Request $request)
    {
        $cart = Cart::firstOrCreate(
            [
                'user_id'   => Auth::id(),
                'product_id' => $product->id,
                'size'      => $request->size ?? null
            ],
            [
                'quantity' => 0
            ]
        );

        $cart->quantity += $request->quantity ?? 1;
        $cart->save();

        return back()->with('success', 'Đã thêm vào giỏ hàng');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::with('product')->findOrFail($id);

        if ($request->has('size')) {
            $cart->size = $request->size;
        }

        if ($request->has('quantity')) {
            $cart->quantity = max(1, (int) $request->quantity);
        }

        $cart->save();

        $product = $cart->product;

        $discountedPrice = $product->discount > 0
            ? $product->price * (1 - $product->discount / 100)
            : $product->price;

        $subtotalOriginal = $product->price * $cart->quantity;
        $subtotalDiscounted = $discountedPrice * $cart->quantity;

        return response()->json([
            'success' => true,
            'quantity' => $cart->quantity,
            'subtotal_original' => $subtotalOriginal,
            'subtotal_discounted' => $subtotalDiscounted,
            'subtotal_original_formatted' => number_format($subtotalOriginal) . ' VNĐ',
            'subtotal_discounted_formatted' => number_format($subtotalDiscounted) . ' VNĐ',
        ]);
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return response()->json(['success' => true]);
    }
}
