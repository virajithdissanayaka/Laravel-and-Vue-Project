<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Address::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'address' => 'required',
        ]);

        $address = Address::create($fields);

        return ['address' => $address];
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        return  $address;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $fields = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'address' => 'required',
        ]);

        $address->update($fields);

        return ['address' => $address];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return ['message' => 'Address deleted'];
    }
}
