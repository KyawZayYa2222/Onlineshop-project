<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    // create subscribe
    public function subscribe(Request $request) {
        $this->ValidationCheck($request);
        $data = [
            'email' => $request->email,
        ];
        Subscriber::create($data);
        return redirect()->back();
    }

    // subscriber list
    public function subscriberList() {
        $subscribers = Subscriber::get();
        return view('admin.subscribers', ['subscribers' => $subscribers]);
    }

    // Delete subscriber
    public function delete($id) {
        Subscriber::where('id', $id)->delete();
        return redirect()->back()->with(['deletesuccess' => 'Subscriber successfully deleted.']);
    }

    private function ValidationCheck($request) {
        Validator::make($request->all(), [
            'email' => 'required|unique:subscribers,email',
        ])->validate();
    }
}
