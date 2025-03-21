

<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <div class="mb-4 p-3 bg-light border rounded">
        <h4 class="mb-0">Restaurant: <?php echo e(Auth::user()->name); ?></h4>
    </div>
    <h2 class="mb-4">Add New Table</h2>

    <!-- Error Messages -->
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Add Table Form -->
    <form method="POST" action="<?php echo e(route('restaurant.tables.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label for="table_number" class="form-label">Table Number</label>
            <input type="text" class="form-control" id="table_number" name="table_number" value="<?php echo e(old('table_number')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">Capacity</label>
            <input type="number" class="form-control" id="capacity" name="capacity" value="<?php echo e(old('capacity')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="Available">Available</option>
                <option value="Occupied">Occupied</option>
                <option value="Reserved">Reserved</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Add Table</button>
        <a href="<?php echo e(route('restaurant.tables.index')); ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script>
    $(document).ready(function () {
           $('#status').select2();
       });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.restaurant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/restaurant/tables/create.blade.php ENDPATH**/ ?>