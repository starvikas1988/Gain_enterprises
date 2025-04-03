


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
    <h2 class="mb-4">Edit Category</h2>

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

    <!-- Edit Form -->
    <form method="POST" action="<?php echo e(route('employee.categories.update', $category->id)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <input type="hidden" name="restaurant_id" value="<?php echo e($restaurantId); ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $category->name)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="icon" class="form-label">Category Icon (Optional)</label>
            <input type="file" class="form-control" id="icon" name="icon">
            <?php if($category->icon): ?>
                <div class="mt-2">
                    
                    <img src="<?php echo e('/uploads/category/' . basename($category->icon)); ?>" alt="Category Icon" width="100" height="100">
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="A" <?php echo e(old('status', $category->status) === 'A' ? 'selected' : ''); ?>>Active</option>
                <option value="D" <?php echo e(old('status', $category->status) === 'D' ? 'selected' : ''); ?>>Deactivated</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="<?php echo e(route('employee.categories.index')); ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.employee', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/Employee/categories/edit.blade.php ENDPATH**/ ?>