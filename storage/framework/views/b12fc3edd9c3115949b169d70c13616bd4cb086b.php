<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <!-- Add Bootstrap for styling (if needed) -->
    <link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/app.min.css')); ?>">
</head>
<body>
    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <script src="<?php echo e(asset('public/backend/assets/js/app.min.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/layouts/app.blade.php ENDPATH**/ ?>