@extends('layouts.restaurant')

@section('content')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h5>Order Details - <span class="fw-bold">#{{ $order->id }}</span></h5>
            <button onclick="printOrder()" class="btn btn-light btn-sm d-print-none">
                <i class="fa fa-print"></i> Print to PDF
            </button>
        </div>
        <div class="card-body" id="printArea">
            
            <!-- Order Summary Section -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
                    <p><strong>Created At:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Payment Status:</strong> 
                        @if($order->payment_status == 'Pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($order->payment_status == 'SUCCESS')
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-danger">Canceled</span>
                        @endif
                    </p>
                    <p><strong>Order Type:</strong> {{ ucfirst($order->order_type) }}</p>
                </div>
            </div>
            
            <hr>

            <!-- Order Items Section -->
            <h6 class="mb-3">Order Items</h6>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price (₹)</th>
                        <th>Subtotal (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sum = 0; @endphp
                    @foreach ($order->orderItems as $index => $item)
                        @php
                            $subtotal = $item->quantity * $item->amount;
                            $sum += $subtotal; 
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><img src="{{ $item->product->image ?? 'https://via.placeholder.com/80' }}" 
                                     alt="{{ $item->product->name }}" class="img-thumbnail" width="80" height="80"></td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₹{{ number_format($item->amount, 2) }}</td>
                            <td>₹{{ number_format($subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">Subtotal:</td>
                        <td>₹{{ number_format($sum, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">Total Discount:</td>
                        <td>- ₹{{ number_format($sum - $order->total_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">GST %:</td>
                        <td>{{ $order->gst_percentage }}%</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">GST Type:</td>
                        <td>{{ ucfirst($order->gst_type) }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">CGST (₹):</td>
                        <td>₹{{ number_format($order->cgst, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">SGST (₹):</td>
                        <td>₹{{ number_format($order->sgst, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">Total Tax (₹):</td>
                        <td>₹{{ number_format($order->total_tax, 2) }}</td>
                    </tr>
                    <tr class="table-primary">
                        <td colspan="5" class="text-end fw-bold">Grand Total:</td>
                        <td>₹{{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Print Function -->
<script>
function printOrder() {
    const printContent = document.getElementById('printArea').innerHTML;
    const originalContent = document.body.innerHTML;
    
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
    window.location.reload(); // Reload to restore functionality
}
</script>

<!-- Print-Specific Styles -->
<style>
/* Apply deep black font color for printing */
@media print {
    body {
        color: #000000 !important;
        font-family: Arial, sans-serif;
    }
    .table-dark {
        color: white !important;
        background-color: black !important;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2 !important;
    }
    .table-bordered th, .table-bordered td {
        border: 1px solid #000000 !important;
    }
}
</style>
@endsection
