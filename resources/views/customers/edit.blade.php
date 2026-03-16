@extends('layouts.layout')

@section('title', 'Edit Customer')
@section('page-header', 'Edit Customer')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-user-edit me-2"></i>Edit Customer</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('customers.update', $customer->id) }}" method="POST" id="editCustomerForm">
                    @csrf
                    @method('PUT')

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" id="customerno" name="customerno"
                                       value="{{ old('customerno', $customer->customerno) }}"
                                       class="form-control @error('customerno') is-invalid @enderror"
                                       placeholder="Customer Number" required>
                                <label for="customerno"><i class="fas fa-id-card me-1"></i> Customer Number</label>
                                @error('customerno')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" id="name" name="name"
                                       value="{{ old('name', $customer->name) }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Full Name" required>
                                <label for="name"><i class="fas fa-user me-1"></i> Full Name</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" id="phone" name="phone"
                                       value="{{ old('phone', $customer->phone) }}"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       placeholder="Phone Number" required>
                                <label for="phone"><i class="fas fa-phone me-1"></i> Phone Number</label>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" id="address" name="address"
                                       value="{{ old('address', $customer->address) }}"
                                       class="form-control @error('address') is-invalid @enderror"
                                       placeholder="Address" required>
                                <label for="address"><i class="fas fa-map-marker-alt me-1"></i> Address</label>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea id="notes" name="notes" class="form-control @error('notes') is-invalid @enderror"
                                          placeholder="Notes" style="height: 100px">{{ old('notes', $customer->notes) }}</textarea>
                                <label for="notes"><i class="fas fa-sticky-note me-1"></i> Additional Notes</label>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <textarea id="preferences" name="preferences" class="form-control @error('preferences') is-invalid @enderror"
                                          placeholder="Preferences" style="height: 110px">{{ old('preferences', $customer->preferences) }}</textarea>
                                <label for="preferences"><i class="fas fa-heart me-1"></i> Preferences</label>
                                @error('preferences')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <textarea id="feedback" name="feedback" class="form-control @error('feedback') is-invalid @enderror"
                                          placeholder="Feedback" style="height: 110px">{{ old('feedback', $customer->feedback) }}</textarea>
                                <label for="feedback"><i class="fas fa-comment-dots me-1"></i> Feedback</label>
                                @error('feedback')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between border-top pt-3">
                        <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Customers
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Customer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const phoneInput = document.getElementById('phone');
        phoneInput.addEventListener('input', function(e) {
            const x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
        });

        const form = document.getElementById('editCustomerForm');
        form.addEventListener('submit', function() {
            if (phoneInput.value) {
                phoneInput.value = phoneInput.value.replace(/\D/g, '');
            }
        });
    });
</script>
@endsection
