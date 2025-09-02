<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Auth::user()->wishlist()->paginate(9);
        return view('user.wishlist', compact('wishlist'));
    }



    public function store(Product $product)
    {
        Auth::user()->wishlist()->syncWithoutDetaching([$product->id]);
        return back()->with('success', 'Đã thêm vào yêu thích!');
    }

    public function destroy(Product $product)
    {
        Auth::user()->wishlist()->detach($product->id);
        return back()->with('success', 'Đã xóa khỏi yêu thích!');
    }


    public function clear()
    {
        Auth::user()->wishlist()->detach();
        return back()->with('success', 'Đã xóa toàn bộ wishlist!');
    }
}
