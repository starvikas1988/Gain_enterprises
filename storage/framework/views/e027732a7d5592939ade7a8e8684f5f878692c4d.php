

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4">Edit Employee</h2>

    <form action="<?php echo e(route('restaurant.employees.update', $employee->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="name" class="form-label">Employee Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo e($employee->name); ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Employee Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo e($employee->email); ?>" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Select Role</label>
            <select class="form-control" id="role" name="role_id" required>
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($role->id); ?>" <?php echo e($role->id == $employeeRole ? 'selected' : ''); ?>><?php echo e($role->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="permissions" class="form-label">Assign Permissions</label>
            <select class="form-control" id="permissions" name="permissions[]" multiple size="10">
                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($permission->id); ?>" <?php echo e(in_array($permission->id, $employeePermissions) ? 'selected' : ''); ?>><?php echo e($permission->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Update Employee</button>
        <a href="<?php echo e(route('restaurant.employees.index')); ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.restaurant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/restaurant/employees/edit.blade.php ENDPATH**/ ?>