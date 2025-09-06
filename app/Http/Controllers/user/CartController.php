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

        return view('user.cart', compact('cartItems'));
    }

    public function store(Product $product, Request $request)
    {
        $cart = Cart::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'size' => $request->size ?? null
            ],
            [
                'quantity' => 0
            ]
        );

        $cart->quantity += $request->quantity ?? 1;
        $cart->save();

        return back()->with('success', 'Đã thêm vào giỏ hàng');
    }

    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        if ($request->has('size')) {
            $cart->size = $request->size;
        }

        if ($request->has('quantity')) {
            $cart->quantity = max(1, (int) $request->quantity);
        }

        $cart->save();

        $subtotal = $cart->product->price * $cart->quantity;

        return response()->json([
            'success' => true,
            'quantity' => $cart->quantity,
            'subtotal' => $subtotal,
            'subtotal_formatted' => number_format($subtotal) . ' VNĐ'
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
