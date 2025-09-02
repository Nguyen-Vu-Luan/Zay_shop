<?php

namespace App\Http\Controllers\orm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Traits\Sortable;

class ProductController extends Controller
{
    use Sortable;

    private function getSortedProducts(Request $request, $query)
    {
        $sort = $request->get('sort');
        return $this->applySort($query, $sort)->paginate(9)->withQueryString();
    }

    public function filterGender(Request $request, $gender)
    {
        $query = Product::with('category')->where('gender', $gender);
        $products = $this->getSortedProducts($request, $query);

        return view('shop', [
            'products'     => $products,
            'gender'       => $gender,
            'slug'         => null,
            'currentPage'  => $products->currentPage(),
            'lastPage'     => $products->lastPage(),
        ]);
    }

    public function filterCategoryGender(Request $request, $slug, $gender)
    {
        $query = Product::with('category')
            ->where('gender', $gender)
            ->whereHas('category', function ($q) use ($slug) {
                $q->where('slug', $slug);
            });

        $products = $this->getSortedProducts($request, $query);

        return view('shop', [
            'products'     => $products,
            'gender'       => $gender,
            'slug'         => $slug,
            'currentPage'  => $products->currentPage(),
            'lastPage'     => $products->lastPage(),
        ]);
    }

    public function filterBrand(Request $request, $brand)
    {
        $query = Product::with('category')->where('brand', $brand);
        $products = $this->getSortedProducts($request, $query);

        return view('shop', [
            'products'     => $products,
            'currentBrand' => $brand,
            'gender'       => null,
            'slug'         => null,
            'currentPage'  => $products->currentPage(),
            'lastPage'     => $products->lastPage(),
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->query('key');

        $products = Product::with('category')
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->paginate(9)
            ->withQueryString(); // giữ lại query string khi phân trang

        return view('shop', [
            'products'    => $products,
            'categories'  => Category::all(),
            'keyword'     => $keyword,
            'slug'        => null,
            'gender'      => null,
            'currentPage' => $products->currentPage(),
            'lastPage'    => $products->lastPage(),
        ]);
    }


    public function showProduct($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('shop-single', compact('product'));
    }
}
