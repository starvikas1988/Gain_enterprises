@extends('layouts.restaurant')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Stock Management</h2>

    <!-- Bulk Upload Form Section -->
    <div class="mb-4 p-3 bg-light border rounded">
        <h5 class="mb-3">Upload Stock Data (Excel)</h5>

        <!-- Download Sample Excel -->
        <a href="{{ route('restaurant.stocks.downloadSample') }}" class="btn btn-success mb-3">Download Sample Excel</a>

        <!-- Upload Form -->
        <form action="{{ route('restaurant.stocks.uploadBulk') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <label for="file" class="form-label">Upload Stock File (Excel)</label>
            <input type="file" name="file" id="file" class="form-control" accept=".xlsx, .csv" required>
            <button type="submit" class="btn btn-primary mt-2">Upload & Update Stock</button>
            
        </form>
        
    </div>

    <!-- Stocks Table Section with Editable Fields -->
    <form action="{{ route('restaurant.stocks.updateBulk') }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th>Default Stock</th>
                    <th>Today's Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stocks as $stock)
                <tr>
                    <td>{{ $stock->id }}</td>
                    <td>{{ $stock->category->name }}</td>
                    <td>{{ $stock->product->name }}</td>
                    
                    <!-- Editable Default Stock -->
                    <td>
                        <input type="number" name="stocks[{{ $stock->id }}][default_stock]" class="form-control" value="{{ $stock->default_stock }}" min="0">
                    </td>

                    <!-- Editable Today's Stock -->
                    <td>
                        <input type="number" name="stocks[{{ $stock->id }}][todays_stock]" class="form-control" value="{{ $stock->todays_stock }}" min="0">
                    </td>

                    <td>
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                         <!-- Delete Button -->
                         <form action="{{ route('restaurant.stocks.destroy', $stock->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this stock?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No Stocks Available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </form>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $stocks->links() }}
    </div>
</div>

@endsection
