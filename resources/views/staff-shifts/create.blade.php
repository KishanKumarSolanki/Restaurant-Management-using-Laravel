@extends('layouts.layout')

@section('title', 'Schedule Staff Shift')
@section('page-header', 'Schedule Staff Shift')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('staff-members.index') }}">Staff</a></li>
    <li class="breadcrumb-item"><a href="{{ route('staff-shifts.index') }}">Shifts</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-calendar-plus me-2"></i>Schedule New Shift</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('staff-shifts.store') }}" method="POST">
                    @csrf
                    @include('staff-shifts._form', ['submitLabel' => 'Save Shift'])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
