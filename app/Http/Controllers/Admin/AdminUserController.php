<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    // Admin profile Page
    public function adminProfilePage() {
        $id = Auth::user()->id;
        $data = User::where('id', $id)->get()->first()->toArray();
        return view('admin.profile', ['userData' => $data]);
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
        return redirect()->route('admin.profile.page');
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
