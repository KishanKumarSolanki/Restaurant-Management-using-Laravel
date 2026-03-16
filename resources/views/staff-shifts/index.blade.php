@extends('layouts.layout')

@section('title', 'Staff Scheduling')
@section('page-header', 'Staff Scheduling')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('staff-members.index') }}">Staff</a></li>
    <li class="breadcrumb-item active">Shifts</li>
@endsection

@section('page-actions')
    <a href="{{ route('staff-members.index') }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-user-check me-1"></i> Staff List
    </a>
    <a href="{{ route('staff-shifts.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-calendar-plus me-1"></i> Schedule Shift
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
                        <th>Staff</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Section</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($staffShifts as $staffShift)
                        <tr>
                            <td>{{ ($staffShifts->currentPage() - 1) * $staffShifts->perPage() + $loop->iteration }}</td>
                            <td>
                                <div class="fw-semibold">{{ $staffShift->staffMember?->name ?? 'Unknown Staff' }}</div>
                                <small class="text-muted">{{ ucfirst($staffShift->staffMember?->role ?? 'staff') }}</small>
                            </td>
                            <td>{{ $staffShift->shift_date?->format('d M Y') }}</td>
                            <td>{{ \Illuminate\Support\Str::of($staffShift->start_time)->substr(0, 5) }} - {{ \Illuminate\Support\Str::of($staffShift->end_time)->substr(0, 5) }}</td>
                            <td>{{ $staffShift->section ?: 'General floor' }}</td>
                            <td>
                                <span class="badge
                                    @if($staffShift->status === 'completed') bg-success
                                    @elseif($staffShift->status === 'in-progress') bg-info
                                    @elseif($staffShift->status === 'off') bg-secondary
                                    @else bg-warning text-dark
                                    @endif">
                                    {{ ucfirst($staffShift->status) }}
                                </span>
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit($staffShift->notes ?: 'No notes', 35) }}</td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('staff-shifts.edit', $staffShift->id) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('staff-shifts.destroy', $staffShift->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Delete this shift?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-calendar-xmark fa-2x text-muted mb-3"></i>
                                <h5 class="text-muted">No staff shifts scheduled yet</h5>
                                <a href="{{ route('staff-shifts.create') }}" class="btn btn-primary mt-2">
                                    <i class="fas fa-calendar-plus me-1"></i> Schedule First Shift
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($staffShifts->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $staffShifts->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
