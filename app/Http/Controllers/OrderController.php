<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $customers = Customer::orderBy('name')->get();
    return view('orders.create', compact('customers'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ordername' => 'required|',
            'customerno' => 'required|',
            'quantity' => 'required|integer|min:1|max:120',
            'amount' => 'required|numeric',
            'status' => 'required|',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
{
    $customers = Customer::orderBy('name')->get();
    return view('orders.edit', compact('order', 'customers'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        

        $order->update($request->only(['ordername', 'customerno', 'quantity', 'amount', 'status']));

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
