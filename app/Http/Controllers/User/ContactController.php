<?php

namespace App\Http\Controllers\User;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function contactPage() {
        if (Auth::check()) {
            $userInfo = [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
            ];
        }else {
            $userInfo = null;
        }
        return view('user.contact', ['userInfo' => $userInfo]);
    }

    public function contactCreate(Request $request) {
        $this->ContactValidationCheck($request);
        $data = $this->RequestData($request);
        Contact::create($data);
        return redirect()->back()->with(['alertsuccess' => 'Your message sucessfully sended. We will reply, solve as fast as to you.']);
    }

    private function ContactValidationCheck($request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ])->validate();
    }

    private function RequestData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ];
    }
}
