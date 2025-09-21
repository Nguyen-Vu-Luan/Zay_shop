<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Auth::user()
            ->wishlist()
            ->select('products.id', 'products.name', 'products.price', 'products.discount', 'products.image')
            ->paginate(6);

        return view('user.wishlist', compact('wishlist'));
    }

    public function store(Product $product)
    {
        $user = Auth::user();

        if ($user->wishlist()->where('product_id', $product->id)->exists()) {
            return back()->with('info', 'Sản phẩm đã có trong wishlist!');
        }

        $user->wishlist()->attach($product->id);

        return back()->with('success', 'Đã thêm vào yêu thích!');
    }

    public function destroy(Product $product)
    {
        Auth::user()->wishlist()->detach($product->id);

        return back()->with('success', 'Đã xóa khỏi yêu thích!');
    }
}
