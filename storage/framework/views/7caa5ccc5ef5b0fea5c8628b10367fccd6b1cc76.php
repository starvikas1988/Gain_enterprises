<div class="table-responsive">
    <table class="table table-centered table-nowrap mb-0">
        <thead class="table-light">
            <tr>
                <th>Sl No.</th>
                <th>Driver</th>
                <th>Route</th>
                <th>Status</th>
                <th>Started At</th>
                <th>Completed At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $serial = $serial[0]; ?>

            <?php if($result->isNotEmpty()): ?>
                <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($serial + $key); ?></td>
                        <td>
                            <?php echo e($trip->driver->name ?? 'N/A'); ?><br>
                            <small class="text-muted"><?php echo e($trip->driver->phone ?? ''); ?></small>
                        </td>
                        <td>
                            <?php echo e($trip->route->name ?? 'N/A'); ?><br>
                            <small class="text-muted"><?php echo e(ucfirst($trip->route->type ?? '-')); ?></small>
                        </td>
                        <td>
                            <span class="badge bg-info"><?php echo e(ucfirst($trip->admin_status)); ?></span><br>
                            <small>Driver: <span class="badge bg-secondary"><?php echo e(ucfirst($trip->driver_status)); ?></span></small>
                        </td>
                        <td><?php echo e($trip->started_at ? date('d M Y, h:i A', strtotime($trip->started_at)) : '-'); ?></td>
                        <td><?php echo e($trip->completed_at ? date('d M Y, h:i A', strtotime($trip->completed_at)) : '-'); ?></td>
                        <td class="d-flex gap-2">
                            <a href="<?php echo e(route('admin.trip.show', ['id' => $trip->id])); ?>"
                               class="btn btn-sm btn-outline-info"
                               title="View">
                                <i class="mdi mdi-eye"></i>
                            </a>

                            <a href="<?php echo e(route('admin.trip.edit', ['id' => $trip->id])); ?>"
                               class="btn btn-sm btn-outline-primary"
                               title="Edit">
                                <i class="mdi mdi-pencil"></i>
                            </a>
                            
                            <a href="<?php echo e(route('admin.trip.manage', ['id' => $trip->id])); ?>"
                            class="btn btn-sm btn-outline-warning"
                            title="Manage Timings">
                                <i class="mdi mdi-clock-outline"></i>
                            </a>

                            
                        <form action="<?php echo e(route('admin.trip.toggle_admin_status', ['id' => $trip->id])); ?>" method="POST" onsubmit="return confirm('Toggle admin status?')">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                class="btn btn-sm <?php echo e($trip->admin_status === 'completed' ? 'btn-danger' : 'btn-success'); ?>"
                                title="<?php echo e($trip->admin_status === 'completed' ? 'Undo Admin Completion' : 'Mark Admin Complete'); ?>">
                                <i class="mdi mdi-check-circle-outline"></i>
                                <?php echo e($trip->admin_status === 'completed' ? 'Undo Complete' : 'Mark Complete'); ?>

                            </button>
                        </form>

                        
                        <form action="<?php echo e(route('admin.trip.toggle_driver_status', ['id' => $trip->id])); ?>" method="POST" onsubmit="return confirm('Toggle driver confirmation?')">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                class="btn btn-sm <?php echo e($trip->driver_status === 'confirmed' ? 'btn-danger' : 'btn-warning'); ?>"
                                title="<?php echo e($trip->driver_status === 'confirmed' ? 'Undo Driver Confirm' : 'Confirm as Driver'); ?>">
                                <i class="mdi mdi-check-circle-outline"></i>
                                <?php echo e($trip->driver_status === 'confirmed' ? 'Undo Confirm' : 'Confirm Driver'); ?>

                            </button>
                        </form>


                            

                            

                            <a href="<?php echo e(route('admin.trip.delete', ['id' => $trip->id])); ?>"
                               class="btn btn-sm btn-outline-danger"
                               title="Delete"
                               onclick="return confirm('Are you sure you want to delete this trip?');">
                                <i class="mdi mdi-delete"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">No trip records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="clearfix mt-3"></div>
    <div align="left"><?php echo $result->links(); ?></div>
</div>
<?php /**PATH C:\xampp\htdocs\logisticsApp\resources\views/admin/trip/table.blade.php ENDPATH**/ ?>