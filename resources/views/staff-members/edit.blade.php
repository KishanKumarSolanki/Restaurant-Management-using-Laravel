@extends('layouts.layout')

@section('title', 'Edit Staff Member')
@section('page-header', 'Edit Staff Member')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('staff-members.index') }}">Staff</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-user-pen me-2"></i>Edit Staff Profile</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('staff-members.update', $staffMember->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('staff-members._form', ['submitLabel' => 'Update Staff'])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
