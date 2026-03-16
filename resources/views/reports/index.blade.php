@extends('layouts.layout')

@section('title', 'Reports & Analytics')
@section('page-header', 'Reports & Analytics')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Reports</li>
@endsection

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <span class="text-muted small text-uppercase">Total Revenue</span>
                <h3 class="mt-2 mb-0">Rs. {{ number_format($salesSummary['total_revenue'], 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <span class="text-muted small text-uppercase">Completed Orders</span>
                <h3 class="mt-2 mb-0">{{ $salesSummary['completed_orders'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <span class="text-muted small text-uppercase">Avg Order Value</span>
                <h3 class="mt-2 mb-0">Rs. {{ number_format($salesSummary['average_order_value'], 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <span class="text-muted small text-uppercase">Pending Orders</span>
                <h3 class="mt-2 mb-0">{{ $salesSummary['pending_orders'] }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Status Breakdown</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Status</th>
                                <th>Total Orders</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statusBreakdown as $status)
                                <tr>
                                    <td>{{ ucfirst($status->status) }}</td>
                                    <td>{{ $status->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-fire me-2"></i>Top Selling Items</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th>Qty Sold</th>
                                <th>Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topItems as $item)
                                <tr>
                                    <td>{{ $item->item?->name ?? 'Deleted Item' }}</td>
                                    <td>{{ $item->total_quantity }}</td>
                                    <td>Rs. {{ number_format($item->total_sales, 2) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center text-muted">No sales data available.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-crown me-2"></i>Top Customers</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Customer No</th>
                                <th>Orders</th>
                                <th>Total Spent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topCustomers as $customer)
                                <tr>
                                    <td>{{ $customer->customerno }}</td>
                                    <td>{{ $customer->total_orders }}</td>
                                    <td>Rs. {{ number_format($customer->total_spent, 2) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center text-muted">No customer spending data available.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Recent Daily Sales</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Orders</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentSales as $day)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($day->sale_date)->format('d M Y') }}</td>
                                    <td>{{ $day->orders_count }}</td>
                                    <td>Rs. {{ number_format($day->daily_revenue, 2) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center text-muted">No recent sales data available.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
