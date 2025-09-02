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

    public function store(Request $request, Product $product)
    {
        $quantity = max(1, (int) $request->input('quantity'));
        $size = $request->input('size') ?? null;

        $existing = Auth::user()->cart()
            ->wherePivot('size', $size)
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $newQty = $existing->pivot->quantity + $quantity;
            Auth::user()->cart()->updateExistingPivot($product->id, [
                'quantity' => $newQty,
                'size' => $size
            ]);
        } else {
            Auth::user()->cart()->attach($product->id, [
                'quantity' => $quantity,
                'size' => $size
            ]);
        }

        return back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    public function update(Request $request, Cart $cart)
    {
        $action = $request->input('action');
        $newSize = $request->input('size');

        if ($newSize) {
            $existing = Cart::where('user_id', Auth::id())
                ->where('product_id', $cart->product_id)
                ->where('size', $newSize)
                ->where('id', '!=', $cart->id)
                ->first();

            if ($existing) {
                $existing->quantity += $cart->quantity;
                $existing->save();
                $cart->delete();
                $cart = $existing;
            } else {
                $cart->size = $newSize;
                $cart->save();
            }
        }

        if ($action === 'increase') {
            $cart->quantity++;
        } elseif ($action === 'decrease') {
            $cart->quantity = max(1, $cart->quantity - 1);
        }

        $cart->save();

        return response()->json([
            'quantity' => $cart->quantity,
            'subtotal' => $cart->product->price * $cart->quantity
        ]);
    }


    public function remove(Cart $cart)
    {
        $cart->delete();
        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ.');
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return back()->with('success', 'Đã xóa toàn bộ giỏ hàng.');
    }
}