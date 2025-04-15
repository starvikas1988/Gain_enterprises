

<?php $__env->startSection('content'); ?>
<!-- Start Page Title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>
<!-- End Page Title -->

<div class="row">
    <div class="col-xl-12 col-lg-12">

        <!-- Total Orders Card -->
        <div class="row">
            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-account-multiple widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0">Total Orders</h5>
                        <h3 class="mt-3 mb-3"><?php echo e($orderCount); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-account-multiple widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0">Today's Overall Stock</h5>
                        <h3 class="mt-3 mb-3"><?php echo e($totalTodayStock); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-account-multiple widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0">Total Purchases</h5>
                        <h3 class="mt-3 mb-3"><?php echo e($totalPurchaseCount); ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOT Orders List (Scrollable without Pagination) -->
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Dine-in Orders</h5>
            </div>
            <div class="card-body" style="height: 300px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Table Number</th>
                            <th>Order Type</th>
                            <th>Total Amount (₹)</th>
                            <th>Order Status</th>
                            <th>Payment Status</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $kotOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($order->id); ?></td>
                            <td><?php echo e($order->table_id ?? 'N/A'); ?></td>
                            <td><?php echo e($order->order_type); ?></td>
                            <td>₹<?php echo e(number_format($order->total_amount, 2)); ?></td>
                            
                            <!-- Order Status Dropdown -->
                            <td>
                                <select class="form-select order-status" data-order-id="<?php echo e($order->id); ?>">
                                    <option value="Pending" <?php echo e($order->order_status == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                                    <option value="Processing" <?php echo e($order->order_status == 'Processing' ? 'selected' : ''); ?>>Processing</option>
                                    <option value="Completed" <?php echo e($order->order_status == 'Completed' ? 'selected' : ''); ?>>Completed</option>
                                </select>
                            </td>
        
                            <!-- Payment Status Dropdown -->
                            <td>
                                <select class="form-select payment-status" data-order-id="<?php echo e($order->id); ?>">
                                    <option value="Pending" <?php echo e($order->payment_status == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                                    <option value="SUCCESS" <?php echo e($order->payment_status == 'SUCCESS' ? 'selected' : ''); ?>>Completed</option>
                                    <option value="Failed" <?php echo e($order->payment_status == 'Failed' ? 'selected' : ''); ?>>Failed</option>
                                </select>
                            </td>
        
                            <td><?php echo e($order->created_at->format('d M Y, h:i A')); ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm update-order-status" data-order-id="<?php echo e($order->id); ?>">Update</button>
                                <a href="<?php echo e(route('employee.orders.view', $order->id)); ?>" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center">No KOT orders available</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        

        <!-- Web Orders List (Scrollable without Pagination) -->
        <div class="card mt-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Home Delivery Orders</h5>
            </div>
            <div class="card-body" style="height: 400px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Platform</th>
                            <th>Order Type</th>
                            <th>Payment Type</th>
                            <th>Total Amount (₹)</th>
                            <th>Order Status</th>
                            <th>Payment Status</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $webOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($order->id); ?></td>
                            <td><?php echo e($order->created_by ?? 'N/A'); ?></td>
                            <td><?php echo e($order->order_type); ?></td>
                            <td><?php echo e($order->payment_type ?? 'RAZORPAY'); ?></td>
                            <td>₹<?php echo e(number_format($order->total_amount, 2)); ?></td>
                            
                            <!-- Order Status Dropdown -->
                            <td>
                                <select class="form-select order-status" data-order-id="<?php echo e($order->id); ?>">
                                    <option value="Pending" <?php echo e($order->order_status == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                                    <option value="Processing" <?php echo e($order->order_status == 'Processing' ? 'selected' : ''); ?>>Processing</option>
                                    <option value="Completed" <?php echo e($order->order_status == 'Completed' ? 'selected' : ''); ?>>Completed</option>
                                </select>
                            </td>
        
                            <!-- Payment Status Dropdown (Conditional based on Payment Type) -->
                            <td>
                                <?php if(in_array($order->payment_type, ['cash', 'upi'])): ?>
                                    <select class="form-select payment-status" data-order-id="<?php echo e($order->id); ?>">
                                        <option value="Pending" <?php echo e($order->payment_status == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                                        <option value="SUCCESS" <?php echo e($order->payment_status == 'SUCCESS' ? 'selected' : ''); ?>>Completed</option>
                                        <option value="Failed" <?php echo e($order->payment_status == 'Failed' ? 'selected' : ''); ?>>Failed</option>
                                    </select>
                                <?php else: ?>
                                <?php if($order->payment_status == 'Pending'): ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php elseif($order->payment_status == 'SUCCESS'): ?>
                                    <span class="badge bg-success">Completed</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?php echo e($order->payment_status); ?></span>
                                <?php endif; ?>
                                <?php endif; ?>
                            </td>
        
                            <td><?php echo e($order->created_at->format('d M Y, h:i A')); ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm change-order-status" data-order-id="<?php echo e($order->id); ?>">Update</button>
                                
                                <a href="<?php echo e(route('employee.orders.view', $order->id)); ?>" class="btn btn-sm btn-primary">View</a>
                              
                                
                                
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="text-center">No Web orders available</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        

    </div>
</div>

<script>
    $(document).on("click", ".update-order-status", function() {
    const orderId = $(this).data("order-id");
    const orderStatus = $(`.order-status[data-order-id="${orderId}"]`).val();
    const paymentStatus = $(`.payment-status[data-order-id="${orderId}"]`).val();

    $.ajax({
        url: "<?php echo e(route('employee.orders.updateStatus')); ?>",
        type: "POST",
        data: {
            _token: "<?php echo e(csrf_token()); ?>",
            order_id: orderId,
            order_status: orderStatus,
            payment_status: paymentStatus
        },
        success: function(response) {
            if (response.success) {
                alert("Order status updated successfully!");
                location.reload(); // Refresh page to reflect changes
            } else {
                alert(response.message || "Failed to update order status.");
            }
        },
        error: function(xhr) {
            alert("An error occurred while updating the order status.");
        }
    });
});

$(document).on("click", ".change-order-status", function() {
    const orderId = $(this).data("order-id");
    const orderStatus = $(`.order-status[data-order-id="${orderId}"]`).val();
    const paymentAccount = $(`.payment-status[data-order-id="${orderId}"]`).length
        ? $(`.payment-status[data-order-id="${orderId}"]`).val()
        : null;
    console.log(orderStatus, paymentAccount);
    $.ajax({
        url: "<?php echo e(route('employee.orders.changeStatus')); ?>",
        type: "POST",
        data: {
            _token: "<?php echo e(csrf_token()); ?>",
            order_id: orderId,
            order_status: orderStatus,
            payment_status: paymentAccount
        },
        success: function(response) {
            if (response.success) {
                alert("Order status updated successfully!");
                location.reload();
            } else {
                alert(response.message || "Failed to update order status.");
            }
        },
        error: function(xhr) {
            alert("An error occurred while updating the order status.");
        }
    });
});


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.employee', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/employee/dashboard.blade.php ENDPATH**/ ?>