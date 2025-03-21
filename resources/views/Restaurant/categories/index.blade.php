@extends('layouts.restaurant')

@section('content')

<div class="container mt-4">
    <div class="mb-4 p-3 bg-light border rounded">
        <h4 class="mb-0">Restaurant: {{ Auth::user()->name }}</h4>
    </div>
    <h2 class="mb-4">Category Management</h2>
    
    <a href="{{ route('restaurant.categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    <!-- Filter Section -->
    <form method="GET" action="{{ route('restaurant.categories.index') }}" class="mb-4">
        <div class="row">
            <!-- Search by Name -->
            <div class="col-md-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Search by Category Name" value="{{ request('name') }}">
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
                <a href="{{ route('restaurant.categories.index') }}" class="btn btn-secondary ms-2">Reset</a>
            </div>
        </div>
    </form>

    <!-- Categories Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            {{-- {{ dd(env('APP_URL'), env('ASSET_URL'), config('app.url'), config('app.asset_url')); }} --}}
            

            <tbody>
                @forelse ($categories as $category)
               
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            @if($category->icon)
                                {{-- <img src="{{ asset($category->icon) }}" alt="icon" width="50" height="50"> --}}
                                <img src="{{ '/uploads/category/' . basename($category->icon) }}" alt="icon" width="50" height="50">

                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $category->status == 'A' ? 'Active' : 'Deactivated' }}</td>
                        <td>{{ $category->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <a href="{{ route('restaurant.categories.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm delete-category" data-id="{{ $category->id }}">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Categories Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.delete-category').click(function () {
            const categoryId = $(this).data('id');
            const csrfToken = "{{ csrf_token() }}";

            if (confirm('Are you sure you want to delete this category? This action is irreversible.')) {
                $.ajax({
                    url: `/restaurant/categories/${categoryId}`,
                    method: 'POST',
                    data: {
                        _token: csrfToken,
                        _method: 'DELETE'
                    },
                    success: function (response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function (xhr) {
                        alert('Failed to delete the category. Error: ' + (xhr.responseJSON?.message || 'Unknown error'));
                    }
                });
            }
        });

        $(document).ready(function () {
            $('#status').select2();
        });

    });
</script>

@endsection
