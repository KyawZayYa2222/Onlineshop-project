<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Read
    public function categoryPage () {
        $categoryData = Category::get()->toArray();
        $countArray = array();
        $i = -1;
        foreach ($categoryData as $data) {
            $i += 1;
            $categoryData[$i] += array('product_count' => count(Product::where('category_id', $data['id'])->get()));
        }
        return view('admin.category', ['categoryData' => $categoryData]);
    }

    // Create
    public function create(Request $request) {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->back()->with(['createsuccess' => 'Category successfully created.']);
    }

    // Update
    public function edit($id) {
        $data = Category::where('id', $id)->get()->toArray();
        return view('admin.category_update', ['categoryData' => $data]);
    }
    public function update (Request $request) {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        $id = $request->upd_id;
        Category::where('id', $id)->update($data);
        return redirect()->route('admin.category.page')->with(['updatesuccess' => 'Category successfully updated.']);
    }

    // Delete
    // public function delete($id) {
    //     Category::where('id', $id)->delete();
    //     return redirect()->route('admin.category.page')->with(['deletesuccess' => 'Category successfully deleted.']);
    // }

    // Validation
    private function categoryValidationCheck ($request) {
        Validator::make($request->all(), [
            'categoryName' => 'required|unique:categories,name'
        ])->validate();
    }
    // Insert Array Data
    private function requestCategoryData($request) {
        return [
            'id' => $request->upd_id,
            'name' => $request->categoryName
        ];
    }
}
