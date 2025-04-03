

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4">Employee Management</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <a href="<?php echo e(route('restaurant.employees.create')); ?>" class="btn btn-primary mb-3">Add Employee</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
               // dd($employees->toArray()); // Debugging line to check the structure of $employees
            ?>
            <?php $__empty_1 = true; $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($employee->id); ?></td>
                <td><?php echo e($employee->name); ?></td>
                <td><?php echo e($employee->email); ?></td>
                <td><?php echo e($employee->role_name ?? 'N/A'); ?></td>
                <td>
                    <?php
                        // Fetch permissions using the correct table
                        $permissions = DB::table('roles_permissions')
                            ->join('permissions', 'roles_permissions.permission_id', '=', 'permissions.id')
                            ->where('roles_permissions.role_id', $employee->role_id)
                            ->pluck('permissions.name')->toArray();

                    ?>
                    <?php if(!empty($permissions)): ?>
                    <ul>
                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($permission); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    No Permissions
                <?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo e(route('restaurant.employees.edit', $employee->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="<?php echo e(route('restaurant.employees.destroy', $employee->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" class="text-center">No Employees Found</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php echo e($employees->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.restaurant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/restaurant/employees/index.blade.php ENDPATH**/ ?>