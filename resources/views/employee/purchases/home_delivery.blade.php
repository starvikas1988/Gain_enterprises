@extends('layouts.employee')

@section('content')
<div class="container mt-4">
    <h4>Dine-In Purchases</h4>
    
    <!-- Search and Date Filter Form -->
    <form method="GET" action="{{ route('employee.purchases.home_delivery') }}" class="mb-3 row g-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by Order Number" value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-3">
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('employee.purchases.home_delivery') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <!-- Purchases Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->total_amount }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('employee.purchases.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('employee.purchases.delete', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this order?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No Home Delivery Purchases Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
</div>
@endsection
