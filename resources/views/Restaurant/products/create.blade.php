@extends('layouts.restaurant')

@section('content')

<div class="container mt-4">
    <div class="mb-4 p-3 bg-light border rounded">
        <h4 class="mb-0">Restaurant: {{ Auth::user()->name }}</h4>
    </div>

    <h2 class="mb-4">Add New Product</h2>

    <!-- Back to Product List -->
    <a href="{{ route('restaurant.products.index') }}" class="btn btn-secondary mb-3">Back to Products</a>

    <!-- Product Form -->
    <form action="{{ route('restaurant.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Product Name -->
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Product Name" value="{{ old('name') }}" required>
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Category Selection -->
            <div class="col-md-6 mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select select2" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Price -->
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Price (₹)</label>
                <input type="number" name="price" id="price" class="form-control" placeholder="Enter Price" value="{{ old('price') }}" required>
                @error('price') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Image Upload -->
            <div class="col-md-6 mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Description -->
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter Product Description">{{ old('description') }}</textarea>
                @error('description') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Recommend Product -->
            <div class="col-md-6 mb-3">
                <label for="is_recommend" class="form-label">Recommend Product</label>
                <select name="is_recommend" id="is_recommend" class="form-select">
                    <option value="NO" {{ old('is_recommend') == 'NO' ? 'selected' : '' }}>No</option>
                    <option value="YES" {{ old('is_recommend') == 'YES' ? 'selected' : '' }}>Yes</option>
                </select>
            </div>

            <!-- Status -->
            <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select select2">
                    <option value="A" {{ old('status') == 'A' ? 'selected' : '' }}>Active</option>
                    <option value="D" {{ old('status') == 'D' ? 'selected' : '' }}>Deactivated</option>
                </select>
            </div>

        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
</div>

<!-- Select2 Initialization -->
<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>

@endsection
