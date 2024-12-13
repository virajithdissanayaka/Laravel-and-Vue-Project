<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Contact::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'phone_number' => 'required',
        ]);

        $contact = Contact::create($fields);

        return ['contact' => $contact];
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return  $contact;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $fields = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'phone_number' => 'required',
        ]);

        $contact->update($fields);

        return ['contact' => $contact];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return ['message' => 'Contact deleted'];
    }
}
