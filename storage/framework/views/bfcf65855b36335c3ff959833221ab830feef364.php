


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

    <h2 class="mb-4">Edit Product - <?php echo e($product->name); ?></h2>

    <!-- Back to Product List -->
    <a href="<?php echo e(route('employee.products.index')); ?>" class="btn btn-secondary mb-3">Back to Products</a>

    <!-- Product Edit Form -->
    <form action="<?php echo e(route('employee.products.update', $product->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="row">
            <input type="hidden" name="restaurant_id" value="<?php echo e($restaurantId); ?>">
            <!-- Product Name -->
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name', $product->name)); ?>" required>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Category Selection -->
            <div class="col-md-6 mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select select2" required>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Price -->
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Price (₹)</label>
                <input type="number" name="price" id="price" class="form-control" value="<?php echo e(old('price', $product->price)); ?>" required>
                <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Image Upload -->
            <div class="col-md-6 mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" name="image" id="image" class="form-control">
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <!-- Display Existing Image -->
                <?php if($product->image): ?>
                    <div class="mt-2">
                        <p>Current Image:</p>
                        <img src="<?php echo e('/uploads/product/' . basename($product->image)); ?>" alt="Category Icon" width="100" height="100">
                        
                    </div>
                <?php endif; ?>
            </div>

            <!-- Description -->
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4"><?php echo e(old('description', $product->description)); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Recommend Product -->
            <div class="col-md-6 mb-3">
                <label for="is_recommend" class="form-label">Recommend Product</label>
                <select name="is_recommend" id="is_recommend" class="form-select">
                    <option value="NO" <?php echo e(old('is_recommend', $product->is_recommend) == 'NO' ? 'selected' : ''); ?>>No</option>
                    <option value="YES" <?php echo e(old('is_recommend', $product->is_recommend) == 'YES' ? 'selected' : ''); ?>>Yes</option>
                </select>
            </div>

            <!-- Status -->
            <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select select2">
                    <option value="A" <?php echo e(old('status', $product->status) == 'A' ? 'selected' : ''); ?>>Active</option>
                    <option value="D" <?php echo e(old('status', $product->status) == 'D' ? 'selected' : ''); ?>>Deactivated</option>
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Update Product</button>
    </form>
</div>

<!-- Select2 Initialization -->
<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.employee', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/employee/products/edit.blade.php ENDPATH**/ ?>