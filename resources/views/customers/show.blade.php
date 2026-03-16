@extends('layouts.layout')

@section('title', 'Customer History')
@section('page-header', 'Customer History')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a></li>
    <li class="breadcrumb-item active">{{ $customer->name }}</li>
@endsection

@section('page-actions')
    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-edit me-1"></i> Edit Customer
    </a>
@endsection

@section('content')
<div class="row g-4 mb-4">
    <div class="col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <span class="text-muted small text-uppercase">Customer Profile</span>
                <h3 class="mt-2 mb-3">{{ $customer->name }}</h3>
                <p class="mb-2"><strong>Customer No:</strong> {{ $customer->customerno }}</p>
                <p class="mb-2"><strong>Phone:</strong> {{ $customer->phone ?: 'N/A' }}</p>
                <p class="mb-2"><strong>Address:</strong> {{ $customer->address }}</p>
                <p class="mb-2"><strong>Notes:</strong> {{ $customer->notes ?: 'No notes added yet.' }}</p>
                <p class="mb-2"><strong>Preferences:</strong> {{ $customer->preferences ?: 'No preferences saved yet.' }}</p>
                <p class="mb-0"><strong>Feedback:</strong> {{ $customer->feedback ?: 'No feedback recorded yet.' }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <span class="text-muted small text-uppercase">Total Orders</span>
                        <h3 class="mt-2 mb-0">{{ $summary['total_orders'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <span class="text-muted small text-uppercase">Completed</span>
                        <h3 class="mt-2 mb-0">{{ $summary['completed_orders'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <span class="text-muted small text-uppercase">Active</span>
                        <h3 class="mt-2 mb-0">{{ $summary['active_orders'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <span class="text-muted small text-uppercase">Total Spent</span>
                        <h3 class="mt-2 mb-0">Rs. {{ number_format($summary['total_spent'], 2) }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Order History</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order</th>
                                        <th>Items</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td>
                                                <div class="fw-semibold">{{ $order->ordername }}</div>
                                                <small class="text-muted">Qty {{ $order->quantity }}</small>
                                            </td>
                                            <td>{{ $order->orderItems->pluck('item.name')->filter()->join(', ') ?: 'No items' }}</td>
                                            <td>Rs. {{ number_format($order->amount, 2) }}</td>
                                            <td><span class="badge bg-secondary">{{ ucfirst($order->status) }}</span></td>
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">No orders found for this customer.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($orders->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $orders->withQueryString()->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
