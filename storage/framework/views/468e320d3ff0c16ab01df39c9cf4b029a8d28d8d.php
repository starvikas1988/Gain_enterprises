<!DOCTYPE html>
<html>
<head>
    <title>Order Token - <?php echo e($order->token_no); ?></title>
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
        @media  print {
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
    <h2>Order Token - <?php echo e($order->token_no); ?></h2>
    <p><strong>Restaurant:</strong> <?php echo e($order->restaurant_name); ?></p>
    <p><strong>Order Type:</strong> <?php echo e($order->order_type); ?></p>
    <?php if($order->table_number): ?>
        <p><strong>Table Number:</strong> <?php echo e($order->table_number); ?></p>
    <?php else: ?>
        <p><strong>Table Number:</strong> N/A</p>
    <?php endif; ?>

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
            <?php $__currentLoopData = $groupedData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->first()->product_name); ?></td>
                    <td><?php echo e($item->first()->quantity); ?></td>
                    <td>₹<?php echo e(number_format($item->first()->item_amount, 2)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <h4 class="total">Total Amount: ₹<?php echo e(number_format($order->total_amount, 2)); ?></h4>

    <!-- Print and Close Buttons -->
    <button onclick="window.print()">Print Token</button>
    <button onclick="window.close()">Close</button>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/restaurant/token_pdf.blade.php ENDPATH**/ ?>