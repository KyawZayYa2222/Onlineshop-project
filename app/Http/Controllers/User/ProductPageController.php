<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductPageController extends Controller
{
    public function productPage() {
        $category = Category::get();
        $product = Product::paginate(8);
        return view('user.product', ['category' => $category, 'product' => $product]);
    }

    public function productAjax(Request $request) {
        // $rawQuery = product::leftJoin('rate_and_reviews', 'products.id', '=', 'rate_and_reviews.product_id')
        //             ->select('products.*', 'rate_and_reviews.star_count');
        switch ($request->status) {
            case 'price':
                if($request->range=='any') {
                    $query = product::get();
                }elseif($request->range=='<50') {
                    $query = product::where('price', '<=', 50)->get();
                }elseif($request->range=='50-200') {
                    $query = product::whereBetween('price', [50, 200])->get();
                }elseif($request->range=='200-500') {
                    $query = product::whereBetween('price', [200, 500])->get();
                }elseif($request->range=='500-900') {
                    $query = product::whereBetween('price', [500, 900])->get();
                }elseif($request->range=='>900') {
                    $query = product::where('price', '>=', 900)->get();
                }
                break;
            case 'category':
                $query = product::where('category_id', $request->id)->get();
                break;
            case 'asc':
                $query = product::orderBy('created_at', 'asc')->get();
                break;
            case 'desc':
                $query = product::orderBy('created_at', 'desc')->get();
                break;
            default:
                $query = product::get();
                break;
        }
        return $query;
    }

    public function productAjaxAll(Request $request) {
        $query = Product::get();
        return $query;
    }
}
