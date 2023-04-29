<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // User profile page
    public function userProfilePage() {
        $id = Auth::user()->id;
        $data = User::where('id', $id)->get()->first()->toArray();
        $orderHistory = Order::leftJoin('products', 'orders.product_id', '=', 'products.id')
                               ->select('orders.*', 'products.name')
                               ->where('user_id', $id)
                               ->get();
        if (count($orderHistory) != 0) {
            return view('user.user_profile', ['userData' => $data, 'orderHistory' => $orderHistory]);
        }else {
            return view('user.user_profile', ['userData' => $data, 'orderHistory' => null]);
        }
    }

    // Personal Info Updating
    public function update($id, Request $request) {
        $old_img = User::where('id', $id)->first()->image;
        if($request->hasFile('image')) {
            if($old_img != null) {
                Storage::delete(['public/'.$old_img]);
            }
            $image = uniqid() . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public', $image);
        }else {
            $image = null;
        }

        $this->UserValidationCheck($id, $request);
        $data = $this->RequestUserData($request, $image);
        User::where('id', $id)->update($data);
        return redirect()->route('user.profile.page');
    }

    // Validation Check
    private function UserValidationCheck($id, $request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'phone' => 'required',
            'address' => 'required',
        ])->validate();
    }
    // Turn To Array
    private function RequestUserData($request, $image) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $image,
        ];
    }

}
