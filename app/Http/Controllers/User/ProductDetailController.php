<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\RateAndReview;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductDetailController extends Controller
{
    public function productDetailPage($id) {
        $details= Product::where('id', $id)->get();
        // dd($details->toArray());
        $rate = RateAndReview::where('product_id', $id)->get();
        return view('user.product_detail', ['details' => $details, 'rate' => $rate]);
    }
}
