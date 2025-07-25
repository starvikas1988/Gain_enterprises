

<?php $__env->startSection('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.trips')); ?>">Trips</a></li>
                    <li class="breadcrumb-item active">Manage Timing</li>
                </ol>
            </div>
            <h4 class="page-title">Manage Trip Timing</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="text-muted font-14"><?php echo $__env->make('admin.include.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></p>

                <div class="mb-4">
                    <strong>Driver:</strong> <?php echo e($trip->driver->name ?? 'N/A'); ?> (<?php echo e($trip->driver->phone ?? ''); ?>)<br>
                    <strong>Route:</strong> <?php echo e($trip->route->name ?? 'N/A'); ?> (<?php echo e(ucfirst($trip->route->type ?? '')); ?>)<br>
                    <strong>Status:</strong> 
                        <span class="badge bg-info"><?php echo e(ucfirst($trip->admin_status)); ?></span>
                        <small class="ms-2">Driver: <span class="badge bg-secondary"><?php echo e(ucfirst($trip->driver_status)); ?></span></small>
                </div>

                <form action="<?php echo e(route('admin.trip.save_timings', ['id' => $trip->id])); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
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
                                        <td>
                                            <?php echo e($store->name); ?>

                                            <input type="hidden" name="store_ids[]" value="<?php echo e($store->id); ?>">
                                        </td>
                                        <td>
                                            <input type="datetime-local" name="arrival_time[<?php echo e($store->id); ?>]" 
                                                   value="<?php echo e(old('arrival_time.' . $store->id, optional($store->pivot->arrival_time)->format('Y-m-d\TH:i'))); ?>"
                                                   class="form-control" />
                                        </td>
                                        <td>
                                            <input type="datetime-local" name="load_time[<?php echo e($store->id); ?>]" 
                                                   value="<?php echo e(old('load_time.' . $store->id, optional($store->pivot->load_time)->format('Y-m-d\TH:i'))); ?>"
                                                   class="form-control" />
                                        </td>
                                        <td>
                                            <input type="datetime-local" name="departure_time[<?php echo e($store->id); ?>]" 
                                                   value="<?php echo e(old('departure_time.' . $store->id, optional($store->pivot->departure_time)->format('Y-m-d\TH:i'))); ?>"
                                                   class="form-control" />
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No stores found in this trip.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-4">
                        <div class="offset-md-6 col-md-3">
                            <a href="<?php echo e(route('admin.trips')); ?>" class="btn btn-secondary d-grid">BACK</a>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary d-grid">SAVE TIMINGS</button>
                        </div>
                    </div>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\logisticsApp\resources\views/admin/trip/manage.blade.php ENDPATH**/ ?>