@extends('layouts.layout')

@section('title', 'Edit Order')
@section('page-header', 'Edit Order')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-edit me-2"></i>Edit Order #{{ $order->id }}
                        </h4>
                        <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-light">
                            <i class="fas fa-arrow-left me-1"></i> Back to Orders
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.update', $order->id) }}" method="POST" id="editOrderForm">
                        @csrf
                        @method('PUT')
                        @include('orders._form', [
                            'submitLabel' => 'Update Order',
                            'cancelLabel' => 'Back to Orders',
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
