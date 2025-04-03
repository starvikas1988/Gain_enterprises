@extends('layouts.employee')
{{-- @section('title', 'Product Management - ' . Auth::user()->name) --}}

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
    <h2 class="mb-4">Product Management</h2>
    
    <a href="{{ route('employee.products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

    <!-- Filter Section -->
    <form method="GET" action="{{ route('employee.products.index') }}" class="mb-4">
        <div class="row">
            <!-- Search by Product Name -->
            <div class="col-md-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Search by Product Name" value="{{ request('name') }}">
            </div>

            <!-- Search by Category -->
            <div class="col-md-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Search by Status -->
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">All</option>
                    <option value="A" {{ request('status') == 'A' ? 'selected' : '' }}>Active</option>
                    <option value="D" {{ request('status') == 'D' ? 'selected' : '' }}>Deactivated</option>
                </select>
            </div>

            <!-- Search by Date -->
            <div class="col-md-3">
                <label for="date" class="form-label">Created Date</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('employee.products.index') }}" class="btn btn-secondary ms-2">Reset</a>
            </div>
        </div>
    </form>

    <!-- Products Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Recommend</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>₹{{ number_format($product->price, 2) }}</td>
                        <td>
                            @if($product->image)
                                {{-- <img src="{{ ($product->image) }}" alt="Product Image" width="50" height="50">  for live--}}
                                <img src="{{ '/uploads/product/' . basename($product->image) }}" alt="icon" width="50" height="50">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $product->is_recommend === 'YES' ? 'Yes' : 'No' }}</td>
                        <td>{{ $product->status == 'A' ? 'Active' : 'Deactivated' }}</td>
                        <td>{{ $product->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <a href="{{ route('employee.products.edit', $product->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm delete-product" data-id="{{ $product->id }}">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No Products Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.delete-product').click(function () {
            const productId = $(this).data('id');
            const csrfToken = "{{ csrf_token() }}";

            if (confirm('Are you sure you want to delete this product? This action is irreversible.')) {
                $.ajax({
                    url: `/employee/products/${productId}`,
                    method: 'POST',
                    xhrFields: { withCredentials: true },
                    data: {
                        _token: csrfToken,
                        _method: 'DELETE'
                    },
                    success: function (response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function (xhr) {
                        alert('Failed to delete the product. Error: ' + (xhr.responseJSON?.message || 'Unknown error'));
                    }
                });
            }
        });
    });

    $(document).ready(function () {
            $('#status').select2();
        });
</script>

@endsection
