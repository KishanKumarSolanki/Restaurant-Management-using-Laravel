<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item - Cafe Express</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6c5ce7;
            --secondary-color: #a29bfe;
            --dark-color: #2d3436;
            --light-color: #f8f9fa;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), #5649d6);
            border-radius: 10px 10px 0 0 !important;
            padding: 1.25rem;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #dee2e6;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(108, 92, 231, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #5649d6;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(108, 92, 231, 0.3);
        }
        
        .btn-outline-secondary {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-outline-secondary:hover {
            transform: translateY(-2px);
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border-radius: 8px 0 0 8px !important;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="fas fa-box me-2"></i>Edit Menu Item
                            </h4>
                            <a href="{{ route('items.index') }}" class="btn btn-sm btn-outline-light">
                                <i class="fas fa-arrow-left me-1"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('items.update', $item->id) }}" method="POST" id="editItemForm">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-tag me-1"></i> Item Name
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-utensils"></i>
                                        </span>
                                        <input type="text" id="name" name="name" 
                                               value="{{ old('name', $item->name) }}" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               placeholder="e.g. Margherita Pizza" required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="price" class="form-label">
                                        <i class="fas fa-dollar-sign me-1"></i> Price
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </span>
                                        <input type="number" id="price" name="price" 
                                               value="{{ old('price', $item->price) }}" 
                                               class="form-control @error('price') is-invalid @enderror" 
                                               placeholder="0.00" step="0.01" min="0" required>
                                        @error('price')
                                            <div class="invalid-feedback">
                                                <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="category" class="form-label">
                                        <i class="fas fa-list me-1"></i> Category
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-folder"></i>
                                        </span>
                                        <select id="category" name="category" 
                                                class="form-select @error('category') is-invalid @enderror" required>
                                            <option value="">Select Category</option>
                                            <option value="Appetizers" {{ old('category', $item->category) == 'Appetizers' ? 'selected' : '' }}>Appetizers</option>
                                            <option value="Main Course" {{ old('category', $item->category) == 'Main Course' ? 'selected' : '' }}>Main Course</option>
                                            <option value="Desserts" {{ old('category', $item->category) == 'Desserts' ? 'selected' : '' }}>Desserts</option>
                                            <option value="Beverages" {{ old('category', $item->category) == 'Beverages' ? 'selected' : '' }}>Beverages</option>
                                            <option value="Specials" {{ old('category', $item->category) == 'Specials' ? 'selected' : '' }}>Specials</option>
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">
                                                <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="fas fa-undo me-1"></i> Reset
                                </button>
                                <div>
                                    <a href="{{ route('items.index') }}" class="btn btn-outline-secondary me-2">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Update Item
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Price input formatting
            const priceInput = document.getElementById('price');
            priceInput.addEventListener('blur', function() {
                if (this.value) {
                    this.value = parseFloat(this.value).toFixed(2);
                }
            });
        });
    </script>
</body>
</html>