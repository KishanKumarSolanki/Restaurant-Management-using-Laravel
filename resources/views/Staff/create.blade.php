@extends('layouts.layout')

@section('title', 'Staff Assignment')
@section('page-header', 'Assign Orders To Staff')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Staff Assignment</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <span class="text-muted small text-uppercase">Active Orders</span>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <h3 class="mb-0">{{ $stats['active_orders'] }}</h3>
                        <span class="badge rounded-pill text-bg-primary px-3 py-2">
                            <i class="fas fa-receipt me-1"></i> Live
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <span class="text-muted small text-uppercase">Unassigned Orders</span>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <h3 class="mb-0">{{ $stats['unassigned_orders'] }}</h3>
                        <span class="badge rounded-pill text-bg-warning px-3 py-2">
                            <i class="fas fa-clock me-1"></i> Action Needed
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <span class="text-muted small text-uppercase">Assigned Today</span>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <h3 class="mb-0">{{ $stats['assigned_today'] }}</h3>
                        <span class="badge rounded-pill text-bg-success px-3 py-2">
                            <i class="fas fa-user-check me-1"></i> Updated
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-user-plus me-2"></i>Assign Order
                    </h4>
                </div>
                <div class="card-body">
                    @if($orders->isEmpty())
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-circle-info me-2"></i>
                            No pending or processing orders are available for assignment.
                        </div>
                    @else
                        <form action="{{ route('staff.store') }}" method="POST" id="staffAssignmentForm">
                            @csrf

                            <div class="mb-3">
                                <label for="order_id" class="form-label fw-semibold">Select Order</label>
                                <select name="order_id" id="order_id" class="form-select @error('order_id') is-invalid @enderror" required>
                                    <option value="">Choose an order</option>
                                    @foreach($orders as $order)
                                        <option
                                            value="{{ $order->id }}"
                                            data-ordername="{{ $order->ordername }}"
                                            data-customer="{{ $order->customerno }}"
                                            data-quantity="{{ $order->quantity }}"
                                            data-amount="{{ number_format($order->amount, 2) }}"
                                            data-status="{{ ucfirst($order->status) }}"
                                            data-assigned="{{ $order->assignment_name ?? 'Unassigned' }}"
                                            {{ old('order_id') == $order->id ? 'selected' : '' }}
                                        >
                                            #{{ $order->id }} - {{ $order->ordername }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('order_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="assigned_staff_name" class="form-label fw-semibold">Staff Name</label>
                                <input
                                    type="text"
                                    name="assigned_staff_name"
                                    id="assigned_staff_name"
                                    class="form-control @error('assigned_staff_name') is-invalid @enderror"
                                    value="{{ old('assigned_staff_name') }}"
                                    placeholder="Example: Rahul, Ankit, Priya"
                                    required
                                >
                                <div class="form-text">Aap yahan directly naam likh sakte ho jisko order dena hai.</div>
                                @error('assigned_staff_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label fw-semibold">Update Status</label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ old('status', 'processing') === 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="assignment_notes" class="form-label fw-semibold">Assignment Notes</label>
                                <textarea
                                    name="assignment_notes"
                                    id="assignment_notes"
                                    rows="4"
                                    class="form-control @error('assignment_notes') is-invalid @enderror"
                                    placeholder="Example: Deliver to table 4 first, then confirm payment."
                                >{{ old('assignment_notes') }}</textarea>
                                @error('assignment_notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between border-top pt-3">
                                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Back To Orders
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-1"></i>Assign Order
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        <i class="fas fa-clipboard-list me-2 text-primary"></i>Order Snapshot
                    </h4>
                </div>
                <div class="card-body">
                    @if($orders->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-box-open fa-3x mb-3"></i>
                            <p class="mb-0">New orders will appear here for staff allocation.</p>
                        </div>
                    @else
                        <div class="rounded-3 border bg-light p-4 mb-4" id="orderPreview">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <span class="text-muted small d-block">Order Name</span>
                                    <strong id="previewOrderName">Select an order</strong>
                                </div>
                                <div class="col-md-6">
                                    <span class="text-muted small d-block">Customer Number</span>
                                    <strong id="previewCustomer">-</strong>
                                </div>
                                <div class="col-md-6">
                                    <span class="text-muted small d-block">Quantity</span>
                                    <strong id="previewQuantity">-</strong>
                                </div>
                                <div class="col-md-6">
                                    <span class="text-muted small d-block">Amount</span>
                                    <strong id="previewAmount">-</strong>
                                </div>
                                <div class="col-md-6">
                                    <span class="text-muted small d-block">Current Status</span>
                                    <strong id="previewStatus">-</strong>
                                </div>
                                <div class="col-md-6">
                                    <span class="text-muted small d-block">Currently Assigned</span>
                                    <strong id="previewAssigned">-</strong>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Assigned Staff</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr class="{{ $order->assignment_name ? '' : 'table-warning' }}">
                                            <td>
                                                <div class="fw-semibold">{{ $order->ordername }}</div>
                                                <small class="text-muted">#{{ $order->id }} &middot; Qty {{ $order->quantity }}</small>
                                            </td>
                                            <td>{{ $order->customerno }}</td>
                                            <td>
                                                <span class="badge
                                                    @if($order->status === 'completed') text-bg-success
                                                    @elseif($order->status === 'processing') text-bg-info
                                                    @elseif($order->status === 'cancelled') text-bg-danger
                                                    @else text-bg-warning
                                                    @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $order->assignment_name ?? 'Unassigned' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const orderSelect = document.getElementById('order_id');

        if (!orderSelect) {
            return;
        }

        const previewFields = {
            ordername: document.getElementById('previewOrderName'),
            customer: document.getElementById('previewCustomer'),
            quantity: document.getElementById('previewQuantity'),
            amount: document.getElementById('previewAmount'),
            status: document.getElementById('previewStatus'),
            assigned: document.getElementById('previewAssigned'),
        };

        const updatePreview = () => {
            const selectedOption = orderSelect.options[orderSelect.selectedIndex];

            if (!selectedOption || !selectedOption.value) {
                previewFields.ordername.textContent = 'Select an order';
                previewFields.customer.textContent = '-';
                previewFields.quantity.textContent = '-';
                previewFields.amount.textContent = '-';
                previewFields.status.textContent = '-';
                previewFields.assigned.textContent = '-';
                return;
            }

            previewFields.ordername.textContent = selectedOption.dataset.ordername || '-';
            previewFields.customer.textContent = selectedOption.dataset.customer || '-';
            previewFields.quantity.textContent = selectedOption.dataset.quantity || '-';
            previewFields.amount.textContent = 'Rs. ' + (selectedOption.dataset.amount || '0.00');
            previewFields.status.textContent = selectedOption.dataset.status || '-';
            previewFields.assigned.textContent = selectedOption.dataset.assigned || 'Unassigned';
        };

        orderSelect.addEventListener('change', updatePreview);
        updatePreview();
    });
</script>
@endpush
