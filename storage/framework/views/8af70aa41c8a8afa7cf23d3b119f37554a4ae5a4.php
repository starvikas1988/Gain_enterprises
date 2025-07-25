

<?php $__env->startSection('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.trips')); ?>">Trip</a></li>
                    <li class="breadcrumb-item active">Add Trip</li>
                </ol>
            </div>
            <h4 class="page-title">Add Trip</h4>
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
                    <form action="<?php echo e(route('admin.trip.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="driver_id" class="form-label">Driver</label>
                                <select name="driver_id" id="driver_id" class="form-select">
                                    <option value="">Select Driver</option>
                                    <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($driver->id); ?>" <?php echo e(old('driver_id') == $driver->id ? 'selected' : ''); ?>>
                                            <?php echo e($driver->name); ?> (<?php echo e($driver->phone); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="route_id" class="form-label">Route</label>
                                <select name="route_id" id="route_id" class="form-select">
                                    <option value="">Select Route</option>
                                    <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($route->id); ?>" <?php echo e(old('route_id') == $route->id ? 'selected' : ''); ?>>
                                            <?php echo e($route->name); ?> (<?php echo e(ucfirst($route->type)); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="row" id="store_list_wrapper">
                            <div class="col-12">
                                <label class="form-label fw-bold">Stores in Route</label>
                                <ul class="list-group" id="store_list">
                                    
                                </ul>
                            </div>
                        </div>

                        <div class="row mt-4">
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

<?php $__env->startSection('script'); ?>
<script>
    let routeData = <?php echo json_encode($routes->keyBy('id'), 15, 512) ?>;

    $('#route_id').change(function () {
        const selectedRouteId = $(this).val();
        const storeListEl = $('#store_list');
        storeListEl.empty();

        if (selectedRouteId && routeData[selectedRouteId]) {
            const stores = routeData[selectedRouteId].stores;

            if (stores.length > 0) {
                stores.forEach((store, index) => {
                    storeListEl.append(`
                        <li class="list-group-item">
                            <strong>Stop ${index + 1}:</strong> ${store.name}
                        </li>
                    `);
                });
            } else {
                storeListEl.append('<li class="list-group-item text-muted">No stores defined in route.</li>');
            }
        }
    });

    // Trigger change on load if old route_id is set
    <?php if(old('route_id')): ?>
        $('#route_id').trigger('change');
    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\logisticsApp\resources\views/admin/trip/create.blade.php ENDPATH**/ ?>