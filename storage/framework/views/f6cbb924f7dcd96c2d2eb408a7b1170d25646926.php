

<?php $__env->startSection('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.trips')); ?>">Trips</a></li>
                    <li class="breadcrumb-item active">Trip Details</li>
                </ol>
            </div>
            <h4 class="page-title">Trip Details</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title mb-3">Basic Trip Information</h4>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Driver:</strong><br>
                        <?php echo e($trip->driver->name ?? 'N/A'); ?><br>
                        <small class="text-muted"><?php echo e($trip->driver->phone ?? ''); ?></small>
                    </div>
                    <div class="col-md-4">
                        <strong>Route:</strong><br>
                        <?php echo e($trip->route->name ?? 'N/A'); ?> (<?php echo e(ucfirst($trip->route->type)); ?>)
                    </div>
                    <div class="col-md-4">
                        <strong>Trip Status:</strong><br>
                        <span class="badge bg-info"><?php echo e(ucfirst($trip->admin_status)); ?></span>
                        <br>
                        <small>Driver Confirmation: <span class="badge bg-secondary"><?php echo e(ucfirst($trip->driver_status)); ?></span></small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Started At:</strong><br>
                        <?php echo e($trip->started_at ? date('d M Y, h:i A', strtotime($trip->started_at)) : 'Not started'); ?>

                    </div>
                    <div class="col-md-4">
                        <strong>Completed At:</strong><br>
                        <?php echo e($trip->completed_at ? date('d M Y, h:i A', strtotime($trip->completed_at)) : 'Not completed'); ?>

                    </div>
                </div>

                <h4 class="header-title mt-4">Store Visit Details</h4>
                <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Store</th>
                                <th>Arrival Time</th>
                                <th>Load Time</th>
                                <th>Departure Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $trip->stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($store->name); ?></td>
                                    <td><?php echo e($store->pivot->arrival_time ? date('d M Y, h:i A', strtotime($store->pivot->arrival_time)) : '-'); ?></td>
                                    <td><?php echo e($store->pivot->load_time ? date('d M Y, h:i A', strtotime($store->pivot->load_time)) : '-'); ?></td>
                                    <td><?php echo e($store->pivot->departure_time ? date('d M Y, h:i A', strtotime($store->pivot->departure_time)) : '-'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No stores visited.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="<?php echo e(route('admin.trips')); ?>" class="btn btn-secondary">Back</a>
                    </div>
                </div>

            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\logisticsApp\resources\views/admin/trip/show.blade.php ENDPATH**/ ?>