<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count();
        $totalItems = Item::count();
        $totalOrders = Order::count();
        $totalStaff = User::count();
        $activeOrders = Order::whereIn('status', ['pending', 'processing'])->count();
        $unassignedOrders = Order::whereIn('status', ['pending', 'processing'])
            ->whereNull('assigned_staff_name')
            ->whereNull('assigned_to')
            ->count();
        $completedOrders = Order::where('status', 'completed')->count();

        $recentAssignments = Order::with('assignedStaff')
            ->where(function ($query) {
                $query->whereNotNull('assigned_to')
                    ->orWhereNotNull('assigned_staff_name');
            })
            ->latest('assigned_at')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalCustomers',
            'totalItems',
            'totalOrders',
            'totalStaff',
            'activeOrders',
            'unassignedOrders',
            'completedOrders',
            'recentAssignments'
        ));
    }
}
