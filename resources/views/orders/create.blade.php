@extends('layouts.layout')

@section('title', 'Create New Order')
@section('page-header', 'New Order')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-clipboard-list me-2"></i>Create New Order
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.store') }}" method="POST" id="createOrderForm">
                        @csrf
                        @include('orders._form', [
                            'submitLabel' => 'Create Order',
                            'cancelLabel' => 'Cancel',
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
