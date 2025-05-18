<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-tachometer-alt me-2"></i>{{ __('Dashboard') }}
            </h2>
            <a href="{{ route('home') }}" 
               class="btn btn-lg rounded-pill shadow-sm"
               style="background-color: #FFD700; border: 2px solid #FFA500; color: #333; font-weight: 600;">
                <i class="fas fa-home me-2"></i>Home
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message - Updated with dark background and white text -->
            <div class="alert alert-dark shadow-sm mb-6 d-flex align-items-center" style="background-color: #343a40;">
                <i class="fas fa-check-circle fa-lg me-3 text-white"></i>
                <span class="fw-bold text-white">{{ __("You're logged in!") }}</span>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4">
                <!-- Customers Card -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm" style="background-color: #FFFACD; border-left: 4px solid #DC3545 !important;">
                        <div class="card-body text-center py-4">
                            <i class="fas fa-users fa-3x mb-3" style="color: #DC3545;"></i>
                            <h3 class="h5 fw-bold text-uppercase text-muted">Total Customers</h3>
                            <p class="display-4 fw-bold my-2">{{ $totalCustomers }}</p>
                        </div>
                    </div>
                </div>

                <!-- Items Card -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm" style="background-color: #FFFACD; border-left: 4px solid #0D6EFD !important;">
                        <div class="card-body text-center py-4">
                            <i class="fas fa-utensils fa-3x mb-3" style="color: #0D6EFD;"></i>
                            <h3 class="h5 fw-bold text-uppercase text-muted">Total Items</h3>
                            <p class="display-4 fw-bold my-2">{{ $totalItems }}</p>
                        </div>
                    </div>
                </div>

                <!-- Orders Card -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm" style="background-color: #FFFACD; border-left: 4px solid #198754 !important;">
                        <div class="card-body text-center py-4">
                            <i class="fas fa-receipt fa-3x mb-3" style="color: #198754;"></i>
                            <h3 class="h5 fw-bold text-uppercase text-muted">Total Orders</h3>
                            <p class="display-4 fw-bold my-2">{{ $totalOrders }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Button hover effects */
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
            background-color: #FFC107 !important;
        }
        .btn:active {
            transform: translateY(0);
        }
        /* Card hover effects */
        .card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
    </style>
</x-app-layout>