

<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <div class="mb-4 p-3 bg-light border rounded">
        <h4 class="mb-0">Restaurant: <?php echo e(Auth::user()->name); ?></h4>
    </div>
    <h2 class="mb-4">Edit Table</h2>

    <!-- Back to Table Management -->
    <a href="<?php echo e(route('restaurant.tables.index')); ?>" class="btn btn-secondary mb-3">Back to Table Management</a>

    <!-- Table Edit Form -->
    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('restaurant.tables.update', $table->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Table Number -->
                <div class="mb-3">
                    <label for="table_number" class="form-label">Table Number</label>
                    <input type="text" id="table_number" name="table_number" class="form-control" value="<?php echo e(old('table_number', $table->table_number)); ?>" required>
                    <?php $__errorArgs = ['table_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Capacity -->
                <div class="mb-3">
                    <label for="capacity" class="form-label">Capacity</label>
                    <input type="number" id="capacity" name="capacity" class="form-control" value="<?php echo e(old('capacity', $table->capacity)); ?>" min="1" required>
                    <?php $__errorArgs = ['capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="Available" <?php echo e($table->status == 'Available' ? 'selected' : ''); ?>>Available</option>
                        <option value="Occupied" <?php echo e($table->status == 'Occupied' ? 'selected' : ''); ?>>Occupied</option>
                        <option value="Reserved" <?php echo e($table->status == 'Reserved' ? 'selected' : ''); ?>>Reserved</option>
                    </select>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-success">Update Table</button>
            </form>
        </div>
    </div>
</div>
<script>

$(document).ready(function() {
    $('#status').select2(); // If using Select2
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.restaurant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/restaurant/tables/edit.blade.php ENDPATH**/ ?>