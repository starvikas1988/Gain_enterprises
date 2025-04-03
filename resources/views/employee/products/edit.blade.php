@extends('layouts.employee')
{{-- @section('title', 'Edit Product - ' . $product->name) --}}

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

    <h2 class="mb-4">Edit Product - {{ $product->name }}</h2>

    <!-- Back to Product List -->
    <a href="{{ route('employee.products.index') }}" class="btn btn-secondary mb-3">Back to Products</a>

    <!-- Product Edit Form -->
    <form action="{{ route('employee.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <input type="hidden" name="restaurant_id" value="{{ $restaurantId }}">
            <!-- Product Name -->
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Category Selection -->
            <div class="col-md-6 mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select select2" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Price -->
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Price (₹)</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                @error('price') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Image Upload -->
            <div class="col-md-6 mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image') <div class="text-danger">{{ $message }}</div> @enderror

                <!-- Display Existing Image -->
                @if($product->image)
                    <div class="mt-2">
                        <p>Current Image:</p>
                        <img src="{{ '/uploads/product/' . basename($product->image) }}" alt="Category Icon" width="100" height="100">
                        {{-- <img src="{{ asset($product->image) }}" alt="Product Image" width="100" height="100"> for live --}}
                    </div>
                @endif
            </div>

            <!-- Description -->
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                @error('description') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Recommend Product -->
            <div class="col-md-6 mb-3">
                <label for="is_recommend" class="form-label">Recommend Product</label>
                <select name="is_recommend" id="is_recommend" class="form-select">
                    <option value="NO" {{ old('is_recommend', $product->is_recommend) == 'NO' ? 'selected' : '' }}>No</option>
                    <option value="YES" {{ old('is_recommend', $product->is_recommend) == 'YES' ? 'selected' : '' }}>Yes</option>
                </select>
            </div>

            <!-- Status -->
            <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select select2">
                    <option value="A" {{ old('status', $product->status) == 'A' ? 'selected' : '' }}>Active</option>
                    <option value="D" {{ old('status', $product->status) == 'D' ? 'selected' : '' }}>Deactivated</option>
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Update Product</button>
    </form>
</div>

<!-- Select2 Initialization -->
<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>

@endsection
