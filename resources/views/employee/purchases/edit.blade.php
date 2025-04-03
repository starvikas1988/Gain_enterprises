@extends('layouts.employee')

@section('content')
<div class="container mt-4">
    <h4>Edit Purchase</h4>
    <form method="POST" action="{{ route('employee.purchases.update', $order->id) }}">
        @csrf
        <div class="mb-3">
            <label>Table Number (Optional for Delivery)</label>
            <input type="number" class="form-control" name="table_id" value="{{ $order->table_id }}" placeholder="Table Number">
        </div>

        <div class="mb-3">
            <label>Total Amount</label>
            <input type="text" class="form-control" name="total_amount" value="{{ $order->total_amount }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Purchase</button>
        <a href="{{ $order->table_id ? route('employee.purchases.dine_in') : route('employee.purchases.home_delivery') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
