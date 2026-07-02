<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $getcontact = Contact::get();
        return view('dash.showcontact', compact('getcontact'));
    }
    public function create()
    {
        return view('web.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email',
            'inquiry_type' => 'nullable|string',
            'message' => 'required',
        ]);

        Contact::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'inquiry_type' => $request->inquiry_type,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully.');
    }









    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        $contact->delete();

        return redirect()->back()->with('success', 'Message deleted successfully.');
    }
}
