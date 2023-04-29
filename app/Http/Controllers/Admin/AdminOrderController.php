<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminOrderController extends Controller
{
    public function orderList() {
        $orderData = Order::join('products', 'orders.product_id', '=', 'products.id')
                          ->join('users', 'orders.user_id', '=', 'users.id')
                          ->select('orders.*', 'products.name as product_name', 'users.name as user_name', 'users.phone', 'users.address')
                          ->get();
        return view('admin.orders', ['orderData' => $orderData]);
    }

    public function orderAction(Request $request) {
        if ($request->status == 'pending') {
            $status = [
                'status' => 'approved',
            ];
        }else {
            $status = [
                'status' => 'pending',
            ];
        }
        Order::where('id', $request->id)->update($status);
        return redirect()->back();
    }

    public function orderDelete($id) {
        order::where('id', $id)->delete();
        return redirect()->back()->with(['deletesuccess' => 'Order sucessfully deleted.']);
    }
}
