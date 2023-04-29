<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function productPage() {
        // $getProduct = DB::table('products')
        //             ->leftJoin('categories','products.category_id', '=', 'categories.id')
        //             ->select('products.*', 'categories.name as category_name')
        //             ->get()
        // ;
        $getProduct = Product::leftJoin('categories','products.category_id', '=', 'categories.id')
                        ->select('products.*', 'categories.name as category_name')
                        ->paginate(10);
        return view('admin.product', ['productData' => $getProduct]);
    }

    // Create
    public function createPage() {
        $getCategory = Category::get();
        return view('admin.product_create', ['categoryData' => $getCategory]);
    }
    public function create(Request $request) {
        $data = $this->InsertData($request);
        Product::create($data);
        return redirect()->route('admin.product.page')->with(['createsuccess' => 'Product successfully created.']);
    }

    // Update
    public function edit($id) {
        $getCategory = Category::get();
        $getProduct = Product::where('id', $id)->get()->toArray();
        return view('admin.product_update', ['categoryData' => $getCategory, 'productData' => $getProduct]);
    }
    public function update(Request $request) {
        $id = $request->upd_id;
        $old_image = Product::where('id', $id)->first()->image;
        $data = $this->InsertData($request);
        Storage::delete(['public/'.$old_image]);
        Product::where('id', $id)->update($data);
        return redirect()->route('admin.product.page')->with(['updatesuccess' => 'Product successfully updated.']);
    }

    // Delete
    public function delete($id) {
        $old_image = Product::where('id', $id)->first()->image;
        Storage::delete(['public/'.$old_image]);
        Product::where('id', $id)->delete();
        return redirect()->route('admin.product.page')->with(['deletesuccess' => 'Product successfully deleted.']);
    }

    // Data Insert Function
     function InsertData($request) {
        $this->ProductValidationCheck($request);
        if ($request->hasFile('image')) {
            $image = uniqid() . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public', $image);
        }
        return $this->RequestProductData($request, $image);
    }
    // Validation
    private function ProductValidationCheck($request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
        ])->validate();
    }
    // Insert Array Data
    private function RequestProductData($request, $image) {
        return [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $image,
            'category_id' => $request->category_id,
        ];
    }
}
