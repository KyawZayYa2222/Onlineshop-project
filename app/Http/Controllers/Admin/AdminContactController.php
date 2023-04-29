<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminContactController extends Controller
{
    public function contactList() {
        $contactData = Contact::get();
        return view('admin.contact', ['contactData' => $contactData]);
    }

    public function contactDelete($id) {
        Contact::where('id', $id)->delete();
        return redirect()->back()->with(['deletesuccess' => 'Contact deleted successfully.']);
    }
}
