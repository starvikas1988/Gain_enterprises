


<?php $__env->startSection('content'); ?>
<?php
    $employee = auth()->guard('employee')->user();
    $restaurantId = $employee->restaurant_id;
    $restaurant = DB::table('restaurants')->where('id', $restaurantId)->first();
?>
<div class="container mt-4">
    <div class="mb-4 p-3 bg-light border rounded">
        <h4 class="mb-0">Restaurant: <?php echo e($restaurant->name); ?></h4>
    </div>
    <h2 class="mb-4">Add New Category</h2>

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

    <!-- Add Form -->
    <form method="POST" action="<?php echo e(route('employee.categories.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="restaurant_id" value="<?php echo e($restaurantId); ?>">
        <input type="hidden" name="created_by" value="<?php echo e($employee->id); ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="icon" class="form-label">Category Icon (Optional)</label>
            <input type="file" class="form-control" id="icon" name="icon" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="A" <?php echo e(old('status') === 'A' ? 'selected' : ''); ?>>Active</option>
                <option value="D" <?php echo e(old('status') === 'D' ? 'selected' : ''); ?>>Deactivated</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Category</button>
        <a href="<?php echo e(route('employee.categories.index')); ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script>
     $(document).ready(function () {
            $('#status').select2();
        });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.employee', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/Employee/categories/create.blade.php ENDPATH**/ ?>