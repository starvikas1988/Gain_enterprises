

<?php $__env->startSection('content'); ?>
<div class="container">
    <h4>Reset Admin Password</h4>
    <form action="<?php echo e(route('admin.password.update')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="token" value="<?php echo e($token); ?>">
        <input type="hidden" name="email" value="<?php echo e(request('email')); ?>">

        <div class="mb-3">
            <label>New Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/auth/admin/passwords/reset.blade.php ENDPATH**/ ?>