<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function wishlistPage() {
        return view('user.wishlist');
    }

    // Add to wishlist by form
    public function addToWishlistByForm(Request $request) {
        $productId = $request->product_id;
        $userId = Auth::user()->id;
        $requestData = $this->RequestedData($productId, $userId);
        if(Wishlist::where(['product_id' => $productId, 'user_id' => $userId])->exists()) {
            return redirect()->route('wishlistpage');
        }else {
            Wishlist::create($requestData);
            return redirect()->route('wishlistpage');
        }
    }

    // whishlist creating or adding in product page
    public function addToWishlist(Request $request) {
        $productId = $request->product_id;
        $userId = Auth::user()->id;
        $requestData = $this->RequestedData($productId, $userId);
        if(Wishlist::where(['product_id' => $productId, 'user_id' => $userId])->exists()) {
            return ['status' => 'existed'];
        }else {
            Wishlist::create($requestData);
            $lastestAdd = Wishlist::rightJoin('products', 'wishlists.product_id', '=', 'products.id')
                    ->where(['user_id'=> $userId, 'product_id'=> $productId])
                    ->get();
            return $lastestAdd;
        }
    }

    // wishlist ajax
    public function wishlistList(Request $request) {
        $userId = Auth::user()->id;
        if($request->status == 'delete') {
            Wishlist::where('id', $request->wish_id)->delete();
        }elseif($request->status == 'addtocart'){
            $productId = $request->product_id;
            $requestData = $this->RequestedData($productId, $userId);
            if(Cart::where(['product_id' => $productId, 'user_id' => $userId])->exists()) {
                Cart::where(['product_id' => $productId, 'user_id' => $userId])->increment('product_count', 1);
            }else {
                Cart::create($requestData);
            }
            Wishlist::where('id', $request->wish_id)->delete();
        }
        return $this->FetchData($userId);
    }

    private function FetchData($userId) {
        $list = Wishlist::join('products', 'wishlists.product_id', '=', 'products.id')
                ->select('wishlists.*', 'products.name', 'products.price', 'products.image')
                ->where('user_id', $userId)
                ->get();
        return $list;
    }

    private function RequestedData($productId, $userId) {
        return [
            'product_id' => $productId,
            'user_id' => $userId,
        ];
    }
}
