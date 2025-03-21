@extends('layouts.restaurant')

@section('content')

<div class="container mt-4">
    <div class="mb-4 p-3 bg-light border rounded">
        <h4 class="mb-0">Restaurant: {{ Auth::user()->name }}</h4>
    </div>
    <h2 class="mb-4">Orders Management</h2>

    <!-- Filter Section -->
    <form method="GET" action="{{ route('restaurant.orders') }}" class="mb-4">
        <div class="row">
            <!-- Search by Order ID -->
            <div class="col-md-3">
                <label for="order_id" class="form-label">Order ID</label>
                <input type="text" name="order_id" id="order_id" class="form-control" placeholder="Search by Order ID" value="{{ request('order_id') }}">
            </div>

            <!-- Search by Status -->
            <div class="col-md-3">
                <label for="payment_status" class="form-label">Payment Status</label>
                <select name="payment_status" id="payment_status" class="form-select">
                    <option value="">All</option>
                    <option value="Pending" {{ request('payment_status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="SUCCESS" {{ request('payment_status') == 'SUCCESS' ? 'selected' : '' }}>Completed</option>
                    <option value="Canceled" {{ request('payment_status') == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </div>

            <!-- Search by Date -->
            <div class="col-md-3">
                <label for="date" class="form-label">Order Date</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('restaurant.orders') }}" class="btn btn-secondary ms-2">Reset</a>
            </div>
        </div>
    </form>

    <!-- Orders Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Order Type</th>
                    <th>Booking Platform</th>
                    <th>Total Amount</th>
                    <th>Payment Status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->order_type }}</td>
                        <td>{{ $order->booking_platform }}</td>
                        <td>₹{{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            @if ($order->payment_status == 'Pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif ($order->payment_status == 'SUCCESS')
                                <span class="badge bg-success">Completed</span>
                            @else
                                <span class="badge bg-danger">Canceled</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <a href="{{ route('restaurant.orders.view', $order->id) }}" class="btn btn-info btn-sm">View</a>
                            <button class="btn btn-danger btn-sm delete-order" data-id="{{ $order->id }}">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Orders Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $orders->links() }}
    </div>

</div>

<!-- Order Details Modal -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="orderDetailsContent">
                <!-- Order details will load here using Ajax -->
                <p>Loading...</p>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

    $('.view-order').click(function () {
        const orderId = $(this).data('id');

        $('#orderDetailsContent').html('<p>Loading order details...</p>');
        $('#orderDetailsModal').modal('show');

        // AJAX call to fetch order details
        $.ajax({
            url: `/restaurant/orders/${orderId}`,
            method: 'GET',
            success: function (response) {
                $('#orderDetailsContent').html(response);
            },
            error: function () {
                $('#orderDetailsContent').html('<p class="text-danger">Failed to load order details.</p>');
            }
        });
    });
    // Delete Order - AJAX with Confirmation
    $('.delete-order').click(function () {
            const orderId = $(this).data('id');
            if (confirm('Are you sure you want to delete this order? This action is irreversible.')) {
                $.ajax({
                    url: `/restaurant/orders/${orderId}`,
                    method: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function () {
                        alert('Failed to delete the order. Please try again.');
                    }
                });
            }
        });
    });


</script>

@endsection
