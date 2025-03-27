<!DOCTYPE html>
<html>
<head>
    <title>Order Token - {{ $order->token_no }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 80mm; /* Adjusted for thermal printer size */
            margin: 0;
            padding: 10px;
        }
        h2 {
            color: #000;
            font-size: 16px;
            text-align: center;
        }
        p {
            font-size: 12px;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12px;
        }
        th, td {
            border-bottom: 1px dashed #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .total {
            font-weight: bold;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            button {
                display: none; /* Hide buttons during print */
            }
        }
    </style>
</head>
<body>
    <h2>Order Token - {{ $order->token_no }}</h2>
    <p><strong>Restaurant:</strong> {{ $order->restaurant_name }}</p>
    <p><strong>Order Type:</strong> {{ $order->order_type }}</p>
    @if($order->table_number)
        <p><strong>Table Number:</strong> {{ $order->table_number }}</p>
    @else
        <p><strong>Table Number:</strong> N/A</p>
    @endif

    <h3>Order Details</h3>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groupedData as $item)
                <tr>
                    <td>{{ $item->first()->product_name }}</td>
                    <td>{{ $item->first()->quantity }}</td>
                    <td>₹{{ number_format($item->first()->item_amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="total">Total Amount: ₹{{ number_format($order->total_amount, 2) }}</h4>

    <!-- Print and Close Buttons -->
    <button onclick="window.print()">Print Token</button>
    <button onclick="window.close()">Close</button>
</body>
</html>
