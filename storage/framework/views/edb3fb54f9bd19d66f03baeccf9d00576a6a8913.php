

<?php $__env->startSection('content'); ?>
<style>
    .btn-space {
        margin-right: 10px;
    }
</style>
<div class="container">
    <h4>Assign Table to Restaurant</h4>

    <form action="<?php echo e(route('admin.table_numbers.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="restaurant_id">Restaurant</label>
            <select name="restaurant_id" class="form-control" required>
                <option value="">-- Select Restaurant --</option>
                <?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($rest->id); ?>"><?php echo e($rest->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label for="table_number">Table Number</label>
            <input type="text" name="table_number" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="capacity">Capacity (optional)</label>
            <input type="number" name="capacity" class="form-control">
        </div>

        <div class="form-group">
            <label for="status">Table Status</label>
            <select name="status" class="form-control" required>
                <option value="Available">Available</option>
                <option value="Occupied">Occupied</option>
                <option value="Reserved">Reserved</option>
            </select>
        </div>

        <div class="d-flex mt-3">
            <a href="<?php echo e(route('admin.table_numbers.index')); ?>" class="btn btn-secondary btn-space">← Back</a>
            <button type="submit" class="btn btn-success">Assign Table</button>
        </div>
      
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/admin/tablenumbers/create.blade.php ENDPATH**/ ?>