<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductSearchController extends Controller
{
    public function search(Request $request) {
        // dd($request->search_key);
        $results = Product::where('name', 'like', '%'.$request->search_key.'%')->get();
        if (count($results) != 0) {
            return view('user.search_result', ['results' => $results]);
        }else {
            return view('user.search_result', ['results' => null]);
        }
    }
}
