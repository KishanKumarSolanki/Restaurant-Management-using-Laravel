<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $customers = customer::paginate(10);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'customerno' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        customer::create($request->all());
        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
{
    $validated = $request->validate([
        'customerno' => 'required|string|max:255',
        'name'       => 'required|string|max:255',
        'phone'      => 'required|string|max:15',
        'address'    => 'required|string|max:255',
        'notes'      => 'nullable|string',
    ]);

    $customer->update($validated);

    return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
