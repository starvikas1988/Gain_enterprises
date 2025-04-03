@extends('layouts.employee')

@section('content')
<div class="container">
    <h4>Manage Today's Stocks</h4>

    <!-- Date Filter Form -->
    {{-- <form method="GET" action="{{ route('restaurant.stocks.todays_stock') }}" class="mb-3">
        <label for="date">Select Date:</label>
        <input type="date" id="date" name="date" value="{{ request('date') }}">
        <button type="submit" class="btn btn-primary">Filter</button>
    </form> --}}

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Category</th>
                <th>Product</th>
                <th>Today's Stock</th>
                <th>Sold Items</th>
                <th>Remaining Stock</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stocks as $stock)
                <tr>
                    <td>{{ $stock->category->name }}</td>
                    <td>{{ $stock->product->name }}</td>
                    <td>{{ $stock->todays_stock }}</td>
                    <td>{{ $stock->sold_quantity }}</td>
                    <td>{{ $stock->remaining_stock }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No stock records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
