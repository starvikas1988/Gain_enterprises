

<?php $__env->startSection('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.drive_route')); ?>">Drive Routes</a></li>
                    <li class="breadcrumb-item active">Route Details</li>
                </ol>
            </div>
            <h4 class="page-title">Route Details</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title mb-3">Route Information</h4>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Route Name:</label>
                        <div><?php echo e($route->name); ?></div>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">Route Type:</label>
                        <div>
                            <?php if($route->type === 'linear'): ?>
                                <span class="badge bg-primary">Linear</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Circular</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label class="fw-bold">Driver:</label>
                        <div>
                            <?php echo e($route->driver->name ?? 'N/A'); ?>

                            <br>
                            <small class="text-muted"><?php echo e($route->driver->phone ?? ''); ?></small>
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label class="fw-bold">Created At:</label>
                        <div><?php echo e($route->created_at->format('d M, Y h:i A')); ?></div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <label class="fw-bold">Stores (in stop order):</label>
                        <ul class="list-group mt-2">
                            <?php $__empty_1 = true; $__currentLoopData = $route->stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li class="list-group-item">
                                    <?php echo e($store->name); ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="list-group-item text-muted">No stores assigned</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <a href="<?php echo e(route('admin.drive_route.edit', ['id' => $route->id])); ?>" class="btn btn-primary">
                            <i class="mdi mdi-pencil"></i> Edit
                        </a>
                        <a href="<?php echo e(route('admin.drive_route')); ?>" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>

            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\logisticsApp\resources\views/admin/drive_route/show.blade.php ENDPATH**/ ?>