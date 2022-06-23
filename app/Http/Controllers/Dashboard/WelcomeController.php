<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Client;
use App\Order;
use App\Product;
use App\User;
use App\Supplier;
use App\OrderSupplier;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderReturn;
use App\OrderSupplierReturn;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $categories_count = Category::count();
        $products_count = Product::count();
        $clients_count = Client::count();
        $users_count = User::whereRoleIs('admin')->count();
        // $users_count = User::count();
        $suppliers_count = Supplier::count();
        $orders_count = Order::count();
        $orders_return_count = OrderReturn::count();
        $orders_suppliers_count = OrderSupplier::count();
        $orders_suppliers_return_count = OrderSupplierReturn::count();

        $sales_data = Order::selectRaw('Year(created_at) year, Month(created_at) month, count(*) count')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->get();

        return view('dashboard.welcome', compact('categories_count','sales_data' ,'products_count', 'clients_count','orders_return_count', 'users_count', 'suppliers_count', 'orders_suppliers_count', 'orders_count','orders_suppliers_return_count'));
    } //end of index

}//end of controller
