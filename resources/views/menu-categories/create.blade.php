@extends('layouts.layout')

@section('title', 'Add Menu Category')
@section('page-header', 'Add Menu Category')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('menu-categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Create Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('menu-categories.store') }}" method="POST">
                    @csrf
                    @include('menu-categories._form', ['submitLabel' => 'Save Category'])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
