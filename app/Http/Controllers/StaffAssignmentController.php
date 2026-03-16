<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class StaffAssignmentController extends Controller
{
    public function create()
    {
        $staffMembers = User::query()
            ->when(
                User::whereNotNull('role')->exists(),
                fn ($query) => $query->whereNotNull('role')
            )
            ->orderBy('name')
            ->get();

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

        return view('Staff.create', compact('orders', 'stats', 'staffMembers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => ['required', 'exists:orders,id'],
            'assigned_to' => ['required', 'exists:users,id'],
            'status' => ['required', 'in:pending,processing,completed,cancelled'],
            'assignment_notes' => ['nullable', 'string', 'max:500'],
        ]);

        $order = Order::findOrFail($validated['order_id']);
        $staffMember = User::findOrFail($validated['assigned_to']);

        $order->update([
            'assigned_to' => $staffMember->id,
            'assigned_staff_name' => null,
            'status' => $validated['status'],
            'assignment_notes' => $validated['assignment_notes'] ?? null,
            'assigned_at' => now(),
        ]);

        return redirect()
            ->route('staff.create')
            ->with('success', "Order {$order->ordername} assigned to {$staffMember->name} successfully.");
    }
}
