

<?php $__env->startSection('content'); ?>
<style>
    .btn-space {
        margin-right: 10px;
    }
</style>
<div class="container">
    <h4>Edit Table Entry</h4>

    <form action="<?php echo e(route('admin.table_numbers.update', $table->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="restaurant_id">Restaurant</label>
            <select name="restaurant_id" class="form-control" required>
                <?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($rest->id); ?>" <?php echo e($rest->id == $table->restaurant_id ? 'selected' : ''); ?>>
                        <?php echo e($rest->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label for="table_number">Table Number</label>
            <input type="text" name="table_number" class="form-control" value="<?php echo e($table->table_number); ?>" required>
        </div>

        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" name="capacity" class="form-control" value="<?php echo e($table->capacity); ?>">
        </div>

        <div class="form-group">
            <label for="status">Table Status</label>
            <select name="status" class="form-control" required>
                <option value="Available" <?php echo e($table->status == 'Available' ? 'selected' : ''); ?>>Available</option>
                <option value="Occupied" <?php echo e($table->status == 'Occupied' ? 'selected' : ''); ?>>Occupied</option>
                <option value="Reserved" <?php echo e($table->status == 'Reserved' ? 'selected' : ''); ?>>Reserved</option>
            </select>
        </div>
        <div class="d-flex mt-3">
            <a href="<?php echo e(route('admin.table_numbers.index')); ?>" class="btn btn-secondary btn-space">← Back</a>
            <button type="submit" class="btn btn-success">Update Table</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/admin/tablenumbers/edit.blade.php ENDPATH**/ ?>