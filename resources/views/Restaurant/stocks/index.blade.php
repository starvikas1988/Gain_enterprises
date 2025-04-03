@extends('layouts.restaurant')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Stock Management</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-4 d-flex justify-content-between">
        <a href="{{ route('restaurant.stocks.create') }}" class="btn btn-primary">Add Stock</a>
        <a href="{{ route('restaurant.stocks.downloadSample') }}" class="btn btn-success">Download Sample Excel</a>
    </div>

    <form action="{{ route('restaurant.stocks.uploadBulk') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <label for="file" class="form-label">Upload Stock File (Excel)</label>
        <input type="file" name="file" id="file" class="form-control" accept=".xlsx, .csv" required>
        <button type="submit" class="btn btn-primary mt-2">Upload & Update Stock</button>
    </form>

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
                    <td>{{ optional($stock->category)->name ?? 'N/A' }}</td>
                    <td>{{ optional($stock->product)->name ?? 'N/A' }}</td>
                    
                    <!-- Editable Default Stock -->
                    <td>
                        <input type="number" name="stocks[{{ $stock->id }}][default_stock]" class="form-control" value="{{ $stock->default_stock }}" min="0">
                    </td>

                    <!-- Editable Today's Stock with Conditional Display -->
                    <td>
                        @php
                            $today = \Carbon\Carbon::today();
                            $isToday = ($stock->updated_at && $stock->updated_at->isToday()) 
                                        || (!$stock->updated_at && $stock->created_at->isToday());
                        @endphp
                        
                        <input type="number" 
                               name="stocks[{{ $stock->id }}][todays_stock]" 
                               class="form-control" 
                               value="{{ $isToday ? $stock->todays_stock : '' }}" 
                               min="0" 
                               placeholder="{{ $isToday ? '' : 'Enter Today\'s Stock' }}">
                    </td>

                    <td>
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $stock->id }})">Delete</button>
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

    <!-- Delete Form (Hidden) -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $stocks->links() }}
    </div>
</div>

<script>
    function confirmDelete(stockId) {
        if (confirm('Are you sure you want to delete this stock?')) {
            const form = document.getElementById('deleteForm');
            form.action = `/restaurant/stocks/${stockId}`;
            form.submit();
        }
    }
</script>

@endsection
