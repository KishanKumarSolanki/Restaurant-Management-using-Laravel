<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer - Cafe Express</title>
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), #5649d6);
            border-radius: 10px 10px 0 0 !important;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(108, 92, 231, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }
        
        .btn-primary:hover {
            background-color: #5649d6;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark-color);
        }
        
        .input-group-text {
            background-color: #e9ecef;
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
                                <i class="fas fa-user-edit me-2"></i>Edit Customer
                            </h4>
                            <a href="{{ route('customers.index') }}" class="btn btn-sm btn-outline-light">
                                <i class="fas fa-arrow-left me-1"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customers.update', $customer->id) }}" method="POST" id="editCustomerForm">
                            @csrf
                            @method('PUT')

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="customerno" class="form-label">
                                        <i class="fas fa-id-card me-1"></i> Customer Number
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-hashtag"></i>
                                        </span>
                                        <input type="text" id="customerno" name="customerno" 
                                               value="{{ old('customerno', $customer->customerno) }}" 
                                               class="form-control @error('customerno') is-invalid @enderror" 
                                               placeholder="CUST-001" required>
                                        @error('customerno')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user me-1"></i> Full Name
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-signature"></i>
                                        </span>
                                        <input type="text" id="name" name="name" 
                                               value="{{ old('name', $customer->name) }}" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               placeholder="John Doe" required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label">
                                        <i class="fas fa-phone me-1"></i> Phone Number
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-mobile-alt"></i>
                                        </span>
                                        <input type="tel" id="phone" name="phone" 
                                               value="{{ old('phone', $customer->phone) }}" 
                                               class="form-control @error('phone') is-invalid @enderror" 
                                               placeholder="(123) 456-7890" required>
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="address" class="form-label">
                                        <i class="fas fa-map-marker-alt me-1"></i> Address
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-home"></i>
                                        </span>
                                        <input type="text" id="address" name="address" 
                                               value="{{ old('address', $customer->address) }}" 
                                               class="form-control @error('address') is-invalid @enderror" 
                                               placeholder="123 Main St, City" required>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="notes" class="form-label">
                                        <i class="fas fa-sticky-note me-1"></i> Additional Notes
                                    </label>
                                    <textarea id="notes" name="notes" class="form-control" 
                                              rows="3" placeholder="Any special instructions or details">{{ old('notes', $customer->notes ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between border-top pt-3">
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="fas fa-undo me-1"></i> Reset
                                </button>
                                <div>
                                    <a href="{{ route('customers.index') }}" class="btn btn-secondary me-2">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Update Customer
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
            // Phone number formatting
            const phoneInput = document.getElementById('phone');
            phoneInput.addEventListener('input', function(e) {
                const x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
            });

            // Form submission handling
            const form = document.getElementById('editCustomerForm');
            form.addEventListener('submit', function(e) {
                // Remove formatting from phone number before submission
                if (phoneInput.value) {
                    phoneInput.value = phoneInput.value.replace(/\D/g, '');
                }
            });
        });
    </script>
</body>
</html>