

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Edit Attendance</li>
                </ol>
            </div>
            <h4 class="page-title">Edit Attendance</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <?php echo $__env->make('admin.include.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <form action="<?php echo e(route('admin.attendance.update', $attendance->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Select Employee</label>
                        <select class="form-select" name="employee_id" id="employee_id" disabled>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($emp->id); ?>" <?php echo e($emp->id == $attendance->employee_id ? 'selected' : ''); ?>><?php echo e($emp->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="login_time" class="form-label">Login Time</label>
                        <input type="datetime-local" class="form-control" name="login_time" id="login_time" value="<?php echo e(\Carbon\Carbon::parse($attendance->login_time)->format('Y-m-d\TH:i')); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="logout_time" class="form-label">Logout Time</label>
                        <input type="datetime-local" class="form-control" name="logout_time" id="logout_time" value="<?php echo e($attendance->logout_time ? \Carbon\Carbon::parse($attendance->logout_time)->format('Y-m-d\TH:i') : ''); ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?php echo e(route('admin.attendance.index')); ?>" class="btn btn-secondary">Back</a>
                </form>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/admin/attendance/edit.blade.php ENDPATH**/ ?>