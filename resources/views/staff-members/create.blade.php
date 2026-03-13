@extends('layouts.layout')

@section('title', 'Add Staff Member')
@section('page-header', 'Add Staff Member')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('staff-members.index') }}">Staff</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>Create Staff Profile</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('staff-members.store') }}" method="POST">
                    @csrf
                    @include('staff-members._form', ['submitLabel' => 'Create Staff'])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
