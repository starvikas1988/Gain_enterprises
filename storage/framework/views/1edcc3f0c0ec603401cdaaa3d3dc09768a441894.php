 

<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h5>Order Details - <span class="fw-bold">#<?php echo e($order->id); ?></span></h5>
            <?php
               // $employeePermissions = auth()->user()->permissions->pluck('permission_slug')->toArray();
               // dd($employeePermissions);
            ?>
            
            <?php if(collect($employeePermissions)->contains('permission_slug', 'print_orders')): ?>
                <button onclick="printOrder()" class="btn btn-light btn-sm d-print-none">
                    <i class="fa fa-print"></i> Print to PDF
                </button>
            <?php endif; ?>

        </div>
        
        <div class="card-body" id="printArea">
            <!-- Order Summary -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Total Amount:</strong> ₹<?php echo e(number_format($order->total_amount, 2)); ?></p>
                    <p><strong>Created At:</strong> <?php echo e($order->created_at->format('d M Y, H:i')); ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Payment Status:</strong> 
                        <?php if($order->payment_status == 'Pending'): ?>
                            <span class="badge bg-warning">Pending</span>
                        <?php elseif($order->payment_status == 'SUCCESS'): ?>
                            <span class="badge bg-success">Completed</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Canceled</span>
                        <?php endif; ?>
                    </p>
                    <p><strong>Order Type:</strong> <?php echo e(ucfirst($order->order_type)); ?></p>
                </div>
            </div>
            
            <hr>

            <!-- Order Items -->
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
                    <?php $sum = 0; ?>
                    <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $subtotal = $item->quantity * $item->amount;
                            $sum += $subtotal; 
                        ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td>
                                <img src="<?php echo e($item->product->image ?? 'https://via.placeholder.com/80'); ?>" 
                                     alt="<?php echo e($item->product->name); ?>" class="img-thumbnail" width="80" height="80">
                            </td>
                            <td><?php echo e($item->product->name); ?></td>
                            <td><?php echo e($item->quantity); ?></td>
                            <td>₹<?php echo e(number_format($item->amount, 2)); ?></td>
                            <td>₹<?php echo e(number_format($subtotal, 2)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">Subtotal:</td>
                        <td>₹<?php echo e(number_format($sum, 2)); ?></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">Total Discount:</td>
                        <td>- ₹<?php echo e(number_format($sum - $order->total_amount, 2)); ?></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">GST %:</td>
                        <td><?php echo e($order->gst_percentage); ?>%</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">GST Type:</td>
                        <td><?php echo e(ucfirst($order->gst_type)); ?></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">CGST (₹):</td>
                        <td>₹<?php echo e(number_format($order->cgst, 2)); ?></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">SGST (₹):</td>
                        <td>₹<?php echo e(number_format($order->sgst, 2)); ?></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">Total Tax (₹):</td>
                        <td>₹<?php echo e(number_format($order->total_tax, 2)); ?></td>
                    </tr>
                    <tr class="table-primary">
                        <td colspan="5" class="text-end fw-bold">Grand Total:</td>
                        <td>₹<?php echo e(number_format($order->total_amount, 2)); ?></td>
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
@media  print {
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.employee', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/Employee/partials/order-details.blade.php ENDPATH**/ ?>