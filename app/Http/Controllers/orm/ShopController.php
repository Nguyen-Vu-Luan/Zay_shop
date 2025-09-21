<?php

namespace App\Http\Controllers\orm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Traits\Sortable;

class ShopController extends Controller
{
    use Sortable;

    private function getSortedProducts(Request $request, $query)
    {
        $sort = $request->get('sort');
        return $this->applySort($query, $sort)->paginate(9)->withQueryString();
    }

    public function showShop(Request $request)
    {
        $query = Product::with('category');
        $products = $this->getSortedProducts($request, $query);

        return view('shop', [
            'products'     => $products,
            'slug'         => null,
            'gender'       => null,
            'currentPage'  => $products->currentPage(),
            'lastPage'     => $products->lastPage(),
        ]);
    }

    public function filterCategories(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $query = Product::with('category')->where('category_id', $category->id);
        $products = $this->getSortedProducts($request, $query);

        return view('shop', [
            'products'     => $products,
            'slug'         => $slug,
            'gender'       => null,
            'currentPage'  => $products->currentPage(),
            'lastPage'     => $products->lastPage(),
        ]);
    }

    
}
