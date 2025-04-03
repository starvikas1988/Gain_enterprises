

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h4>Dine-In Purchases</h4>
    
    <!-- Search and Date Filter Form -->
    <form method="GET" action="<?php echo e(route('employee.purchases.home_delivery')); ?>" class="mb-3 row g-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by Order Number" value="<?php echo e(request('search')); ?>">
        </div>
        <div class="col-md-3">
            <input type="date" name="start_date" class="form-control" value="<?php echo e(request('start_date')); ?>">
        </div>
        <div class="col-md-3">
            <input type="date" name="end_date" class="form-control" value="<?php echo e(request('end_date')); ?>">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="<?php echo e(route('employee.purchases.home_delivery')); ?>" class="btn btn-secondary">Reset</a>
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
            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($order->id); ?></td>
                    <td><?php echo e($order->total_amount); ?></td>
                    <td><?php echo e($order->payment_status); ?></td>
                    <td><?php echo e($order->created_at->format('d-m-Y H:i')); ?></td>
                    <td>
                        <a href="<?php echo e(route('employee.purchases.edit', $order->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('employee.purchases.delete', $order->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this order?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center">No Home Delivery Purchases Found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        <?php echo e($orders->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.employee', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/employee/purchases/home_delivery.blade.php ENDPATH**/ ?>