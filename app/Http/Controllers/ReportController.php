<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $salesSummary = [
            'total_revenue' => Order::where('status', 'completed')->sum('amount'),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'average_order_value' => Order::where('status', 'completed')->avg('amount') ?? 0,
            'pending_orders' => Order::whereIn('status', ['pending', 'processing'])->count(),
        ];

        $statusBreakdown = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->orderBy('status')
            ->get();

        $topItems = OrderItem::query()
            ->select('item_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(line_total) as total_sales'))
            ->with('item')
            ->groupBy('item_id')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();

        $topCustomers = Order::query()
            ->select('customerno', DB::raw('COUNT(*) as total_orders'), DB::raw('SUM(amount) as total_spent'))
            ->where('status', 'completed')
            ->groupBy('customerno')
            ->orderByDesc('total_spent')
            ->take(5)
            ->get();

        $recentSales = Order::query()
            ->selectRaw('DATE(created_at) as sale_date, COUNT(*) as orders_count, SUM(amount) as daily_revenue')
            ->where('status', 'completed')
            ->groupByRaw('DATE(created_at)')
            ->orderByDesc('sale_date')
            ->take(7)
            ->get()
            ->reverse()
            ->values();

        return view('reports.index', compact(
            'salesSummary',
            'statusBreakdown',
            'topItems',
            'topCustomers',
            'recentSales'
        ));
    }
}
