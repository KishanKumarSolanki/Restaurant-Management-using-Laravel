<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class StaffAssignmentController extends Controller
{
    public function create()
    {
        $orders = Order::with('assignedStaff')
            ->whereIn('status', ['pending', 'processing'])
            ->orderByRaw("CASE WHEN assigned_to IS NULL AND assigned_staff_name IS NULL THEN 0 ELSE 1 END")
            ->latest()
            ->get();

        $stats = [
            'active_orders' => $orders->count(),
            'unassigned_orders' => $orders->filter(fn ($order) => blank($order->assignment_name))->count(),
            'assigned_today' => $orders->filter(
                fn ($order) => filled($order->assignment_name) && $order->assigned_at?->isToday()
            )->count(),
        ];

        return view('Staff.create', compact('orders', 'stats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => ['required', 'exists:orders,id'],
            'assigned_staff_name' => ['required', 'string', 'max:100'],
            'status' => ['required', 'in:pending,processing,completed,cancelled'],
            'assignment_notes' => ['nullable', 'string', 'max:500'],
        ]);

        $order = Order::findOrFail($validated['order_id']);
        $order->update([
            'assigned_to' => null,
            'assigned_staff_name' => $validated['assigned_staff_name'],
            'status' => $validated['status'],
            'assignment_notes' => $validated['assignment_notes'] ?? null,
            'assigned_at' => now(),
        ]);

        return redirect()
            ->route('staff.create')
            ->with('success', "Order {$order->ordername} assigned to {$validated['assigned_staff_name']} successfully.");
    }
}
