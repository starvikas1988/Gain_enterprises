

<?php $__env->startSection('content'); ?>
<div class="container">
    <h4>All Table Numbers</h4>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <a href="<?php echo e(route('admin.table_numbers.create')); ?>" class="btn btn-success mb-3">+ Add New Table</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Table Number</th>
                <th>Capacity</th>
                <th>Status</th>
                <th>Restaurant</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $tableNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($table->id); ?></td>
                    <td><?php echo e($table->table_number); ?></td>
                    <td><?php echo e($table->capacity); ?></td>
                    <td><?php echo e($table->status); ?></td>
                    <td><?php echo e($table->restaurant->name ?? 'N/A'); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.table_numbers.edit', $table->id)); ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="<?php echo e(route('admin.table_numbers.delete', $table->id)); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center">No table entries found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        <?php echo e($tableNumbers->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/admin/tablenumbers/index.blade.php ENDPATH**/ ?>