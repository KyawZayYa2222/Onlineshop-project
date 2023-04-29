<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Password Changing
    public function changePassword(Request $request) {
        $this->PasswordValidationCheck($request);
        $user = User::where('id', $request->id)->first();
        if(Hash::check($request->current_password, $user->password)) {
            if($request->password == $request->password_confirmation) {
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->back();
            }else {
                return redirect()->back()->with(['confirmerror'=>'Password Confirmation is not same, try again.', 'passFail'=>'fail']);
            }
        }else {
            return redirect()->back()->with(['oldpasserror'=>'current password is not correct, try again.', 'passFail'=>'fail']);
        }
    }


    // Validation Check
    private function PasswordValidationCheck($request) {
        Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ])->validate();
    }
}
