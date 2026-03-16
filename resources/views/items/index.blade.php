@extends('layouts.layout')

@section('title', 'Items Management')
@section('page-header', 'Items List')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Items</li>
@endsection

@section('page-actions')
    <a href="{{ route('menu-categories.index') }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-folder-tree me-1"></i> Categories
    </a>
    <a href="{{ route('items.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus-circle me-1"></i> Add Item
    </a>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-boxes me-2"></i>Items Management
            </h5>
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
                            <th class="text-nowrap"><i class="fas fa-tag me-1"></i> Name</th>
                            <th class="text-nowrap"><i class="fas fa-dollar-sign me-1"></i> Price</th>
                            <th class="text-nowrap"><i class="fas fa-list me-1"></i> Category</th>
                            <th class="text-nowrap"><i class="fas fa-align-left me-1"></i> Description</th>
                            <th class="text-nowrap"><i class="fas fa-toggle-on me-1"></i> Availability</th>
                            <th class="text-nowrap text-end"><i class="fas fa-cog me-1"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $index => $item)
                            <tr>
                                <td>{{ ($items->currentPage() - 1) * $items->perPage() + $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->menuCategory?->name ?: $item->category }}</td>
                                <td>{{ Str::limit($item->description ?: 'No description added.', 40) }}</td>
                                <td>
                                    <span class="badge {{ $item->is_available ? 'bg-success' : 'bg-danger' }}">
                                        {{ $item->is_available ? 'Available' : 'Out of Stock' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('items.edit', $item->id) }}" 
                                           class="btn btn-outline-primary"
                                           data-bs-toggle="tooltip" 
                                           title="Edit Item">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-outline-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $item->id }}"
                                                title="Delete Item">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-box-open fa-2x mb-3 text-muted"></i>
                                    <h5 class="text-muted">No Items Found</h5>
                                    <a href="{{ route('items.create') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-plus-circle me-1"></i> Add Your First Item
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($items->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $items->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

{{-- 🧱 DELETE MODALS OUTSIDE TABLE --}}
@foreach ($items as $item)
<div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete item <strong>{{ $item->name }}</strong>?</p>
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Cancel
                </button>
                <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
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
