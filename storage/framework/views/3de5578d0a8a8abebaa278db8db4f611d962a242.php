

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Add Attendance</li>
                </ol>
            </div>
            <h4 class="page-title">Add Attendance</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <?php echo $__env->make('admin.include.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <form action="<?php echo e(route('admin.attendance.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Select Employee</label>
                        <select class="form-select" name="employee_id" id="employee_id">
                            <option value="">Select Employee</option>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($emp->id); ?>"><?php echo e($emp->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="login_time" class="form-label">Login Time</label>
                        <input type="datetime-local" class="form-control" name="login_time" id="login_time" required>
                    </div>

                    <div class="mb-3">
                        <label for="logout_time" class="form-label">Logout Time (Optional)</label>
                        <input type="datetime-local" class="form-control" name="logout_time" id="logout_time">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo e(route('admin.attendance.index')); ?>" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/admin/attendance/create.blade.php ENDPATH**/ ?>