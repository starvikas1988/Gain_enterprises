

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h4>Edit Purchase</h4>
    <form method="POST" action="<?php echo e(route('employee.purchases.update', $order->id)); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label>Table Number (Optional for Delivery)</label>
            <input type="number" class="form-control" name="table_id" value="<?php echo e($order->table_id); ?>" placeholder="Table Number">
        </div>

        <div class="mb-3">
            <label>Total Amount</label>
            <input type="text" class="form-control" name="total_amount" value="<?php echo e($order->total_amount); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Purchase</button>
        <a href="<?php echo e($order->table_id ? route('employee.purchases.dine_in') : route('employee.purchases.home_delivery')); ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.employee', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/employee/purchases/edit.blade.php ENDPATH**/ ?>