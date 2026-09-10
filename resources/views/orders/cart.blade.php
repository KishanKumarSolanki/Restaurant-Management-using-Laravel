@extends('layouts.layout')

@section('title', 'Cart')
@section('page-header', 'Cart')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Cart</li>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-cart-shopping me-2"></i>Customer Orders In Cart
                </h4>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark fs-6">{{ $cartCount ?? $cartOrders->count() }} in cart</span>
                    <a href="{{ route('orders.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus-circle me-1"></i> Create Order
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($cartOrders->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-cart-arrow-down fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Abhi cart me koi order nahin hai.</h5>
                        <p class="text-muted mb-3">Jo order create karoge, woh yahan sidha show hoga.</p>
                        <a href="{{ route('orders.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle me-1"></i> Create Order
                        </a>
                    </div>
                @else
                    <div class="d-flex flex-column gap-3">
                        @foreach($cartOrders as $order)
                            <div class="border rounded-3 p-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-3">
                                        <span class="text-muted small text-uppercase d-block">Customer</span>
                                        <div class="fw-semibold">{{ $order->customerno }}</div>
                                        <div class="text-muted small">{{ $order->ordername }}</div>
                                    </div>

                                    <div class="col-lg-4">
                                        <span class="text-muted small text-uppercase d-block">Order Items</span>
                                        <div>
                                            {{ $order->orderItems->pluck('item.name')->filter()->join(', ') ?: 'No items' }}
                                        </div>
                                        <div class="text-muted small">Qty {{ $order->quantity }}</div>
                                    </div>

                                    <div class="col-lg-2">
                                        <span class="text-muted small text-uppercase d-block">Amount</span>
                                        <div class="fw-semibold">Rs. {{ number_format($order->amount, 2) }}</div>
                                    </div>

                                    <div class="col-lg-3">
                                        <form action="{{ route('orders.cart.update', $order->id) }}" method="POST" class="row g-2">
                                            @csrf
                                            @method('PATCH')
                                            <div class="col-8">
                                                <select name="payment_method" class="form-select" required>
                                                    <option value="cash" {{ $order->payment_method === 'cash' ? 'selected' : '' }}>Cash</option>
                                                    <option value="online" {{ $order->payment_method === 'online' ? 'selected' : '' }}>Online</option>
                                                </select>
                                            </div>
                                            <div class="col-4 d-grid">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                        <div class="small text-muted mt-2">
                                            Payment: {{ ucfirst($order->payment_method ?: 'pending') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
