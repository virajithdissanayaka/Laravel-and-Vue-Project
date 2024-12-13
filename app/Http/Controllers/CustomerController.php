<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default 10 items per page
        $search = $request->input('search', '');

        $customers = Customer::with(['address', 'contacts'])
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('nic', 'like', "%{$search}%")
                            ->orWhereHas('address', function ($addressQuery) use ($search) {
                                $addressQuery->where('address', 'like', "%{$search}%");
                            })
                            ->orWhereHas('contacts', function ($contactsQuery) use ($search) {
                                $contactsQuery->where('phone_number', 'like', "%{$search}%");
                            });
            })
            ->paginate($perPage);

        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255',
            'nic' => 'required',
        ]);

        $customer = Customer::create($fields);

        return ['customer' => $customer];
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
{
    // Load the related address and contacts with the customer
    $customer->load(['address', 'contacts']);

    return response()->json($customer);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $fields = $request->validate([
            'name' => 'required|max:255',
            'nic' => 'required',
        ]);

        $customer->update($fields);

        return ['customer' => $customer];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return ['message' => 'Customer deleted'];
    }
}
