@extends('layouts.layout')

@section('title', 'Order Management')
@section('page-header', 'Order List')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Orders</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-clipboard-list me-2"></i>Order Management
            </h5>
            <a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus-circle me-1"></i> Create Order
            </a>
        </div>
        <div class="card-body">
            @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-2"></i> {{ Session::pull('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th class="text-nowrap">#</th>
                            <th class="text-nowrap"><i class="fas fa-file-signature me-1"></i> Order</th>
                            <th class="text-nowrap"><i class="fas fa-user-tag me-1"></i> Customer No</th>
                            <th class="text-nowrap"><i class="fas fa-boxes me-1"></i> Quantity</th>
                            <th class="text-nowrap"><i class="fas fa-money-bill-wave me-1"></i> Amount</th>
                            <th class="text-nowrap"><i class="fas fa-info-circle me-1"></i> Status</th>
                            <th class="text-nowrap text-end"><i class="fas fa-cog me-1"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $index => $order)
                            <tr>
                                <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
                                <td>{{ $order->ordername }}</td>
                                <td>{{ $order->customerno }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ number_format($order->amount, 2) }}</td>
                                <td>
                                    <span class="badge 
                                        @if($order->status == 'completed') bg-success
                                        @elseif($order->status == 'pending') bg-warning text-dark
                                        @elseif($order->status == 'cancelled') bg-danger
                                        @else bg-secondary
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('orders.edit', $order->id) }}" 
                                           class="btn btn-outline-primary"
                                           data-bs-toggle="tooltip" 
                                           title="Edit Order">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-outline-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $order->id }}"
                                                title="Delete Order">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-clipboard fa-2x mb-3 text-muted"></i>
                                    <h5 class="text-muted">No Orders Found</h5>
                                    <a href="{{ route('orders.create') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-plus-circle me-1"></i> Create First Order
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $orders->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Delete Modals Outside Table --}}
@foreach ($orders as $order)
<div class="modal fade" id="deleteModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete order <strong>{{ $order->ordername }}</strong>?</p>
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" 
                        style="transition: all 0.3s ease;" 
                        onmouseover="this.style.backgroundColor='#6c757d'; this.style.transform='scale(1.02)'" 
                        onmouseout="this.style.backgroundColor=''; this.style.transform=''">
                    <i class="fas fa-times me-1"></i> Cancel
                </button>
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                            style="transition: all 0.3s ease;" 
                            onmouseover="this.style.backgroundColor='#c82333'; this.style.transform='scale(1.02)'" 
                            onmouseout="this.style.backgroundColor=''; this.style.transform=''">
                        <i class="fas fa-trash-alt me-1"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
@endsection
