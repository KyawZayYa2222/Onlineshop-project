<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function welcomePage() {
        $productData = Product::orderBy('created_at', 'desc')->take(8)->get();
        // dd($productData->toArray());
        return view('user.welcome', ['productData' => $productData]);
    }
}
