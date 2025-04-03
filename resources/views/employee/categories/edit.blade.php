@extends('layouts.employee')
{{-- @section('title', 'Edit Category - Restaurant Management System') --}}

@section('content')

@php
    $employee = auth()->guard('employee')->user();
    $restaurantId = $employee->restaurant_id;
    $restaurant = DB::table('restaurants')->where('id', $restaurantId)->first();
@endphp

<div class="container mt-4">
    <div class="mb-4 p-3 bg-light border rounded">
        <h4 class="mb-0">Restaurant: {{ $restaurant->name }}</h4>
    </div>
    <h2 class="mb-4">Edit Category</h2>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Form -->
    <form method="POST" action="{{ route('employee.categories.update', $category->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="restaurant_id" value="{{ $restaurantId }}">
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="icon" class="form-label">Category Icon (Optional)</label>
            <input type="file" class="form-control" id="icon" name="icon">
            @if ($category->icon)
                <div class="mt-2">
                    {{-- <img src="{{ asset(($category->icon)) }}" alt="Category Icon" width="100" height="100"> for live --}}
                    <img src="{{ '/uploads/category/' . basename($category->icon) }}" alt="Category Icon" width="100" height="100">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="A" {{ old('status', $category->status) === 'A' ? 'selected' : '' }}>Active</option>
                <option value="D" {{ old('status', $category->status) === 'D' ? 'selected' : '' }}>Deactivated</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ route('employee.categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
