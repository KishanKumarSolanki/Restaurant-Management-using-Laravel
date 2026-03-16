@extends('layouts.layout')

@section('title', 'Edit Menu Category')
@section('page-header', 'Edit Menu Category')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('menu-categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-pen me-2"></i>Edit Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('menu-categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('menu-categories._form', ['submitLabel' => 'Update Category'])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
