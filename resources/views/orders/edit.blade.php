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

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="ordername" id="ordername" 
                                           class="form-control @error('ordername') is-invalid @enderror" 
                                           value="{{ old('ordername', $order->ordername) }}"
                                           placeholder="Order Reference" required>
                                    <label for="ordername">
                                        <i class="fas fa-file-signature me-1"></i> Order Reference
                                    </label>
                                    @error('ordername')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="customerno" id="customerno" 
                                            class="form-select @error('customerno') is-invalid @enderror" required>
                                        <option value="">Select Customer</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->customerno }}" {{ old('customerno', $order->customerno) == $customer->customerno ? 'selected' : '' }}>
                                                {{ $customer->name }} ({{ $customer->customerno }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="customerno">
                                        <i class="fas fa-user-tag me-1"></i> Customer
                                    </label>
                                    @error('customerno')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" name="quantity" id="quantity" 
                                           class="form-control @error('quantity') is-invalid @enderror" 
                                           value="{{ old('quantity', $order->quantity) }}"
                                           placeholder="Quantity" min="1" required>
                                    <label for="quantity">
                                        <i class="fas fa-boxes me-1"></i> Quantity
                                    </label>
                                    @error('quantity')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" name="amount" id="amount" 
                                           class="form-control @error('amount') is-invalid @enderror" 
                                           value="{{ old('amount', $order->amount) }}"
                                           placeholder="0.00" step="0.01" min="0" required>
                                    <label for="amount">
                                        <i class="fas fa-money-bill-wave me-1"></i> Amount
                                    </label>
                                    @error('amount')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select name="status" id="status" 
                                            class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ old('status', $order->status) == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <label for="status">
                                        <i class="fas fa-info-circle me-1"></i> Status
                                    </label>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="notes" id="notes" 
                                              class="form-control @error('notes') is-invalid @enderror" 
                                              placeholder="Order Notes"
                                              style="height: 100px">{{ old('notes', $order->notes ?? '') }}</textarea>
                                    <label for="notes">
                                        <i class="fas fa-sticky-note me-1"></i> Special Instructions
                                    </label>
                                    @error('notes')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between border-top pt-3">
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-1"></i> Reset Changes
                            </button>
                            <div>
                                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary me-2">
                                    <i class="fas fa-times me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update Order
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Amount input formatting
        const amountInput = document.getElementById('amount');
        amountInput.addEventListener('blur', function() {
            if (this.value) {
                this.value = parseFloat(this.value).toFixed(2);
            }
        });

        // Form validation
        const form = document.getElementById('editOrderForm');
        form.addEventListener('submit', function() {
            // Ensure amount is properly formatted before submission
            if (amountInput.value) {
                amountInput.value = parseFloat(amountInput.value).toFixed(2);
            }
        });
    });
</script>
@endsection