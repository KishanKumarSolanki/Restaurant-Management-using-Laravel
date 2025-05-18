<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count();
        $totalItems = Item::count();
        $totalOrders = Order::count();

        return view('dashboard',compact('totalCustomers', 'totalItems', 'totalOrders'));
    }
}
