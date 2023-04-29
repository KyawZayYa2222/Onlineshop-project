<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function adminDashboard() {
        $recentOrders = Order::join('products', 'orders.product_id', '=', 'products.id')
                        ->join('users', 'orders.user_id', '=', 'users.id')
                        ->select('orders.*', 'products.name as product_name', 'products.price', 'users.name as user_name')
                        ->orderBy('created_at', 'desc')->take(10)
                        ->get();
        $maxRateProducts = Product::orderBy('rate', 'desc')->take(5)->get();
        $icomes = 0;
        $orders = Order::get();
        foreach ($orders as $order) {
            $icomes += $order->cost;
        }
        $reports = [
            'saleCount' => count(Order::get()),
            'revenue' => $icomes,
            'subscribers' => count(Subscriber::get()),
        ];
        return view('admin.index', ['recentSales' => $recentOrders, 'topRateProducts' => $maxRateProducts, 'reports' => $reports]);
    }
}
