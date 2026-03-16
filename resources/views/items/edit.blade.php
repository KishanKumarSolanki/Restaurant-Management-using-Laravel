@extends('layouts.layout')

@section('title', 'Edit Menu Item')
@section('page-header', 'Edit Menu Item')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('items.index') }}">Menu Items</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('page-actions')
    <a href="{{ route('menu-categories.index') }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-folder-tree me-1"></i> Manage Categories
    </a>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-box me-2"></i>Edit Menu Item</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('items.update', $item->id) }}" method="POST" id="editItemForm">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" id="name" name="name"
                                       value="{{ old('name', $item->name) }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Item Name" required>
                                <label for="name"><i class="fas fa-utensils me-1"></i> Item Name</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" id="price" name="price"
                                       value="{{ old('price', $item->price) }}"
                                       class="form-control @error('price') is-invalid @enderror"
                                       placeholder="0.00" step="0.01" min="0" required>
                                <label for="price"><i class="fas fa-dollar-sign me-1"></i> Price</label>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select id="menu_category_id" name="menu_category_id"
                                        class="form-select @error('menu_category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ (string) old('menu_category_id', $item->menu_category_id) === (string) $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="menu_category_id"><i class="fas fa-folder-open me-1"></i> Category</label>
                                @error('menu_category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select id="is_available" name="is_available"
                                        class="form-select @error('is_available') is-invalid @enderror" required>
                                    <option value="1" {{ old('is_available', (string) (int) $item->is_available) == '1' ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ old('is_available', (string) (int) $item->is_available) == '0' ? 'selected' : '' }}>Out of Stock</option>
                                </select>
                                <label for="is_available"><i class="fas fa-toggle-on me-1"></i> Availability</label>
                                @error('is_available')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea id="description" name="description"
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Description"
                                          style="height: 110px">{{ old('description', $item->description) }}</textarea>
                                <label for="description"><i class="fas fa-align-left me-1"></i> Description</label>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                        <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to List
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Item
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
        const priceInput = document.getElementById('price');
        priceInput.addEventListener('blur', function() {
            if (this.value) {
                this.value = parseFloat(this.value).toFixed(2);
            }
        });
    });
</script>
@endsection
