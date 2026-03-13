@extends('layouts.layout')

@section('title', 'Staff Management')
@section('page-header', 'Staff Management')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Staff</li>
@endsection

@section('page-actions')
    <a href="{{ route('staff.create') }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-user-check me-1"></i> Assign Orders
    </a>
    <a href="{{ route('staff-members.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus-circle me-1"></i> Add Staff
    </a>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Wage</th>
                        <th>Assigned Orders</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($staffMembers as $staffMember)
                        <tr>
                            <td>{{ ($staffMembers->currentPage() - 1) * $staffMembers->perPage() + $loop->iteration }}</td>
                            <td>{{ $staffMember->name }}</td>
                            <td>{{ $staffMember->email }}</td>
                            <td><span class="badge bg-info-subtle text-info-emphasis border">{{ ucfirst($staffMember->role ?? 'staff') }}</span></td>
                            <td>{{ $staffMember->phone ?: 'N/A' }}</td>
                            <td>{{ $staffMember->wage ? number_format($staffMember->wage, 2) : 'N/A' }}</td>
                            <td>{{ $staffMember->assigned_orders_count }}</td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('staff-members.edit', $staffMember->id) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('staff-members.destroy', $staffMember->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Delete this staff member?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-user-slash fa-2x text-muted mb-3"></i>
                                <h5 class="text-muted">No staff members found</h5>
                                <a href="{{ route('staff-members.create') }}" class="btn btn-primary mt-2">
                                    <i class="fas fa-plus-circle me-1"></i> Add First Staff Member
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($staffMembers->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $staffMembers->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
