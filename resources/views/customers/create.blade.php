@extends('layouts.layout')

@section('title', 'Add New Customer')
@section('page-header', 'Add New Customer')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/customers') }}">Customers</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-user-plus me-2"></i>Customer Information
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('customers.store') }}" method="POST" id="customer-form">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="customerno" id="customerno" 
                                           class="form-control @error('customerno') is-invalid @enderror" 
                                           value="{{ old('customerno') }}" 
                                           placeholder="Customer Number" required>
                                    <label for="customerno" class="form-label">
                                        <i class="fas fa-id-card me-1"></i> Customer Number
                                    </label>
                                    @error('customerno')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" id="name" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name') }}" 
                                           placeholder="Full Name" required>
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user me-1"></i> Full Name
                                    </label>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" name="phone" id="phone" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           value="{{ old('phone') }}" 
                                           placeholder="Phone Number" required>
                                    <label for="phone" class="form-label">
                                        <i class="fas fa-phone me-1"></i> Phone Number
                                    </label>
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="address" id="address" 
                                           class="form-control @error('address') is-invalid @enderror" 
                                           value="{{ old('address') }}" 
                                           placeholder="Complete Address" required>
                                    <label for="address" class="form-label">
                                        <i class="fas fa-map-marker-alt me-1"></i> Complete Address
                                    </label>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Additional Fields (optional) -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="notes" id="notes" 
                                              class="form-control @error('notes') is-invalid @enderror" 
                                              placeholder="Additional Notes"
                                              style="height: 100px">{{ old('notes') }}</textarea>
                                    <label for="notes" class="form-label">
                                        <i class="fas fa-sticky-note me-1"></i> Additional Notes
                                    </label>
                                    @error('notes')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ url('/customers') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back to Customers
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Save Customer
                            </button>
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
        // Phone number formatting
        const phoneInput = document.getElementById('phone');
        phoneInput.addEventListener('input', function(e) {
            const x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
        });

        // Form validation
        const form = document.getElementById('customer-form');
        form.addEventListener('submit', function(e) {
            // Remove any non-digit characters from phone before submission
            if (phoneInput.value) {
                phoneInput.value = phoneInput.value.replace(/\D/g, '');
            }
        });
    });
</script>
@endsection