<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để truy cập!');
        }

        if (auth()->user()->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Bạn không có quyền truy cập Admin!');
        }

        $stats = [
            'users' => User::count(),
            'products' => Product::count(),
            'orders' => Order::count(),
            'revenue' => Order::sum('total_price'),
        ];
        return view('admin.dashboard', compact('stats'));
    }


    /* ================= USER CRUD ================= */
    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'Thêm user thành công!');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        return redirect()->route('admin.users')->with('success', 'Cập nhật user thành công!');
    }

    public function deleteUser($id)
    {
        User::destroy($id);
        return redirect()->route('admin.users')->with('success', 'Xóa user thành công!');
    }

    /* ================= PRODUCT CRUD ================= */
    public function products()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        Product::create($request->all());
        return redirect()->route('admin.products')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $product->update($request->all());
        return redirect()->route('admin.products')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function deleteProduct($id)
    {
        Product::destroy($id);
        return redirect()->route('admin.products')->with('success', 'Xóa sản phẩm thành công!');
    }

    /* ================= ORDER CRUD ================= */
    public function orders()
    {
        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function viewOrder($id)
    {
        $order = Order::with('user')->findOrFail($id);
        return view('admin.orders.view', compact('order'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate(['status' => 'required']);
        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders')->with('success', 'Cập nhật trạng thái thành công!');
    }

    public function deleteOrder($id)
    {
        Order::destroy($id);
        return redirect()->route('admin.orders')->with('success', 'Xóa đơn hàng thành công!');
    }
}
