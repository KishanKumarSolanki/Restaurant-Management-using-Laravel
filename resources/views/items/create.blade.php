@extends('layouts.layout')

@section('title', 'Add New Menu Item')
@section('page-header', 'Add New Item')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('items.index') }}">Menu Items</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>New Menu Item
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('items.store') }}" method="POST" id="createItemForm">
                        @csrf

                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="name" id="name" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name') }}"
                                           placeholder="Item Name" required>
                                    <label for="name">
                                        <i class="fas fa-utensils me-1"></i> Item Name
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
                                    <input type="number" name="price" id="price" 
                                           class="form-control @error('price') is-invalid @enderror" 
                                           value="{{ old('price') }}"
                                           placeholder="0.00" step="0.01" min="0" required>
                                    <label for="price">
                                        <i class="fas fa-dollar-sign me-1"></i> Price
                                    </label>
                                    @error('price')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="category" id="category" 
                                            class="form-select @error('category') is-invalid @enderror" required>
                                        <option value="">Select Category</option>
                                        <option value="Appetizers" {{ old('category') == 'Appetizers' ? 'selected' : '' }}>Appetizers</option>
                                        <option value="Main Course" {{ old('category') == 'Main Course' ? 'selected' : '' }}>Main Course</option>
                                        <option value="Desserts" {{ old('category') == 'Desserts' ? 'selected' : '' }}>Desserts</option>
                                        <option value="Beverages" {{ old('category') == 'Beverages' ? 'selected' : '' }}>Beverages</option>
                                        <option value="Specials" {{ old('category') == 'Specials' ? 'selected' : '' }}>Specials</option>
                                    </select>
                                    <label for="category">
                                        <i class="fas fa-list me-1"></i> Category
                                    </label>
                                    @error('category')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="description" id="description" 
                                              class="form-control @error('description') is-invalid @enderror" 
                                              placeholder="Item Description"
                                              style="height: 100px">{{ old('description') }}</textarea>
                                    <label for="description">
                                        <i class="fas fa-align-left me-1"></i> Description (Optional)
                                    </label>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between border-top pt-3">
                            <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back to List
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Save Item
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
        // Price input formatting
        const priceInput = document.getElementById('price');
        priceInput.addEventListener('blur', function() {
            if (this.value) {
                this.value = parseFloat(this.value).toFixed(2);
            }
        });

        // Form validation
        const form = document.getElementById('createItemForm');
        form.addEventListener('submit', function() {
            // Ensure price is properly formatted before submission
            if (priceInput.value) {
                priceInput.value = parseFloat(priceInput.value).toFixed(2);
            }
        });
    });
</script>
@endsection