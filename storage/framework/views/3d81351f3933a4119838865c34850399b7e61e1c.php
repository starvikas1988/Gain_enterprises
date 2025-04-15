

<?php $__env->startSection('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Attendance List</li>
                </ol>
            </div>
            <h4 class="page-title">Attendance List</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php echo $__env->make('admin.include.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="d-flex justify-content-between mb-3">
                    
                    <a href="<?php echo e(route('admin.attendance.export')); ?>" class="btn btn-success">Export Excel</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Login Time</th>
                                <th>Logout Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($attendances->firstItem() + $key); ?></td>
                                    <td><?php echo e($attendance->employee->name ?? 'N/A'); ?></td>
                                    <td><?php echo e($attendance->login_time); ?></td>
                                    <td><?php echo e($attendance->logout_time ?? 'N/A'); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.attendance.edit', $attendance->id)); ?>" class="btn btn-sm btn-info">Edit</a>
                                        <form action="<?php echo e(route('admin.attendance.destroy', $attendance->id)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this record?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="5">No attendance found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        <?php echo $attendances->links(); ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/admin/attendance/index.blade.php ENDPATH**/ ?>