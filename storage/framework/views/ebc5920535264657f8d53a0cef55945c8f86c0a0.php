

<?php $__env->startSection('content'); ?>
<div class="container">
    <h4>Manage Today's Stocks</h4>

    <!-- Date Filter Form -->
    

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
            <?php $__empty_1 = true; $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($stock->category->name); ?></td>
                    <td><?php echo e($stock->product->name); ?></td>
                    <td><?php echo e($stock->todays_stock); ?></td>
                    <td><?php echo e($stock->sold_quantity); ?></td>
                    <td><?php echo e($stock->remaining_stock); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5">No stock records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.restaurant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/restaurant/stocks/todays_stock.blade.php ENDPATH**/ ?>