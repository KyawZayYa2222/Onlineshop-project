<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AddToCartController extends Controller
{
    public function cartPage() {
        return view('user.cart');
    }

    // Add to cart by form
    public function addToCartByForm(Request $request) {
        // dd($request->toArray());
        $productId = $request->product_id;
        $userId = Auth::user()->id;
        $requestData = $this->RequestedData($productId, $userId);
        if(Cart::where(['product_id' => $productId, 'user_id' => $userId])->exists()) {
            Cart::where(['product_id' => $productId, 'user_id' => $userId])->increment('product_count', 1);
            return redirect()->route('cartpage');
        }else {
            Cart::create($requestData);
            return redirect()->route('cartpage');
        }
    }

    // Add to cart and show cart list with ajax
    public function addToCart(Request $request) {
        $productId = $request->product_id;
        $userId = Auth::user()->id;
        $requestData = $this->RequestedData($productId, $userId);
        if(Cart::where(['product_id' => $productId, 'user_id' => $userId])->exists()) {
            Cart::where(['product_id' => $productId, 'user_id' => $userId])->increment('product_count', 1);
        }else {
            Cart::create($requestData);
        }
        $lastestAdd = Cart::rightJoin('products', 'carts.product_id', '=', 'products.id')
                    ->where(['user_id'=> $userId, 'product_id'=> $productId])
                    ->get();
        return $lastestAdd;
    }

    //cart list using ajax
    public function cartList(Request $request) {
        $userId = Auth::user()->id;

        if($request->status == "update") {
            // product count updating
            Cart::where('id', $request->cartId)->update(['product_count' => $request->productCount]);
            return $this->FetchData($userId);
        }else {
            return $this->FetchData($userId);
        }
    }

    // deleting cart
    public function cartDelete($id) {
        Cart::where('id', $id)->delete();
        return redirect()->back();
    }

    // checkout
    public function checkout(Request $request) {
        // getting total cost
        $cart = Cart::join('products', 'carts.product_id', '=', 'products.id')
                      ->select('carts.*', 'products.price')
                      ->where('user_id', Auth::user()->id)
                      ->get();
        $total = 0;
        foreach ($cart as $cartData) {
            $total += $cartData->product_count * $cartData->price;
        }
        return view('user.payment', ['method' => $request->payment, 'totalCost' => $total]);
    }

    private function FetchData($userId) {
        $cartList = Cart::join('products', 'carts.product_id', '=', 'products.id')
                ->select('carts.*', 'products.name', 'products.price', 'products.image')
                ->where('user_id', $userId)
                ->get();
        return $cartList;
    }

    private function RequestedData($productId, $userId) {
        return [
            'product_id' => $productId,
            'user_id' => $userId,
        ];
    }
}


// $lastestAdd = Cart::rightJoin('products', 'carts.product_id', '=', 'products.id')
            //             // ->latest()
            //             ->get();
            // return $lastestAdd;
