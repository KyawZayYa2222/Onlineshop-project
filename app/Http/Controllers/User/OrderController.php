<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order(Request $request) {
        $userId = Auth::user()->id;
        $items = Cart::where('user_id', $userId)->get();
        foreach ($items as $item) {
            $productData = Product::where('id', $item->product_id)->get();
            $orderData = [
                'product_id' => $item->product_id,
                'product_count' => $item->product_count,
                'cost' => $productData->first()->price * $item->product_count,
                'user_id' => $item->user_id,
            ];
            Order::create($orderData);
        }
        Cart::where('user_id', $userId)->delete();
        return redirect()->route('cartpage')->with(['ordersuccess' => 'Order Success. Your order is processing, See your order at order history!']);
    }
}
