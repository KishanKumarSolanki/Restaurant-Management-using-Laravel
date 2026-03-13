<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['assignedStaff', 'orderItems.item'])->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $items = Item::orderBy('category')->orderBy('name')->get();

        return view('orders.create', compact('customers', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateOrder($request);
        $preparedItems = $this->prepareOrderItems($validated['items']);

        DB::transaction(function () use ($validated, $preparedItems) {
            $order = Order::create([
                'ordername' => $validated['ordername'],
                'customerno' => $validated['customerno'],
                'quantity' => $preparedItems['total_quantity'],
                'amount' => $preparedItems['total_amount'],
                'status' => $validated['status'],
                'notes' => $validated['notes'] ?? null,
            ]);

            $this->syncOrderItems($order, $preparedItems['items']);
        });

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
        $order->load('orderItems.item');
        $customers = Customer::orderBy('name')->get();
        $items = Item::orderBy('category')->orderBy('name')->get();

        return view('orders.edit', compact('order', 'customers', 'items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $this->validateOrder($request);
        $preparedItems = $this->prepareOrderItems($validated['items']);

        DB::transaction(function () use ($order, $validated, $preparedItems) {
            $order->update([
                'ordername' => $validated['ordername'],
                'customerno' => $validated['customerno'],
                'quantity' => $preparedItems['total_quantity'],
                'amount' => $preparedItems['total_amount'],
                'status' => $validated['status'],
                'notes' => $validated['notes'] ?? null,
            ]);

            $order->orderItems()->delete();
            $this->syncOrderItems($order, $preparedItems['items']);
        });

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

    private function validateOrder(Request $request): array
    {
        return $request->validate([
            'ordername' => 'required|string|max:255',
            'customerno' => 'required|string|max:255',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'notes' => 'nullable|string|max:500',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1|max:50',
            'items.*.item_notes' => 'nullable|string|max:255',
            'items.*.item_status' => 'required|in:pending,preparing,ready,served',
        ]);
    }

    private function prepareOrderItems(array $items): array
    {
        $itemModels = Item::whereIn('id', collect($items)->pluck('item_id')->unique()->all())
            ->get()
            ->keyBy('id');

        $preparedItems = collect($items)->map(function (array $line) use ($itemModels) {
            $item = $itemModels->get($line['item_id']);

            abort_unless($item, 422, 'Selected item was not found.');

            $quantity = (int) $line['quantity'];
            $unitPrice = (float) $item->price;

            return [
                'item_id' => $item->id,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'line_total' => $quantity * $unitPrice,
                'item_notes' => $line['item_notes'] ?? null,
                'item_status' => $line['item_status'],
            ];
        });

        return [
            'items' => $preparedItems->all(),
            'total_quantity' => $preparedItems->sum('quantity'),
            'total_amount' => $preparedItems->sum('line_total'),
        ];
    }

    private function syncOrderItems(Order $order, array $items): void
    {
        foreach ($items as $item) {
            $order->orderItems()->create($item);
        }
    }
}
