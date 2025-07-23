

<?php $__env->startSection('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.drive_route')); ?>">Drive Routes</a></li>
                    <li class="breadcrumb-item active">Add Route</li>
                </ol>
            </div>
            <h4 class="page-title">Add Drive Route</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="text-muted font-14">
                    <?php echo $__env->make('admin.include.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </p>

                <div class="tab-content">
                    <form action="<?php echo e(route('admin.drive_route.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Route Name</label>
                                <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" class="form-control" placeholder="Route name">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="type" class="form-label">Route Type</label>
                                <select id="type" name="type" class="form-select">
                                    <option value="">Select type</option>
                                    <option value="linear" <?php echo e(old('type') == 'linear' ? 'selected' : ''); ?>>Linear</option>
                                    <option value="circular" <?php echo e(old('type') == 'circular' ? 'selected' : ''); ?>>Circular</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="driver_id" class="form-label">Driver</label>
                                <select id="driver_id" name="driver_id" class="form-select">
                                    
                                    <option value="">Select driver</option>
                                    <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($driver->id); ?>" <?php echo e(old('driver_id') == $driver->id ? 'selected' : ''); ?>>
                                            <?php echo e($driver->name); ?> (<?php echo e($driver->phone); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="store_ids" class="form-label">Stores (in stop order)</label>
                                <select id="store_ids" name="store_ids[]" class="form-select" multiple size="6">
                                    <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($store->id); ?>" <?php echo e(collect(old('store_ids'))->contains($store->id) ? 'selected' : ''); ?>>
                                            <?php echo e($store->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple stores in order</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="offset-md-8 col-md-4">
                                <button type="submit" class="btn d-grid btn-primary">SUBMIT</button>
                            </div>
                        </div>

                    </form>
                </div> <!-- end tab-content-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\logisticsApp\resources\views/admin/drive_route/create.blade.php ENDPATH**/ ?>