

<?php $__env->startSection('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.drivers')); ?>">Driver</a></li>
                    <li class="breadcrumb-item active">Edit Driver</li>
                </ol>
            </div>
            <h4 class="page-title">Edit Driver</h4>
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
                    <form action="<?php echo e(route('admin.driver.update', ['id' => $driver->id])); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" value="<?php echo e(old('name', $driver->name)); ?>" class="form-control" placeholder="Name">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" value="<?php echo e(old('email', $driver->email)); ?>" class="form-control" placeholder="Email">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" name="phone" value="<?php echo e(old('phone', $driver->phone)); ?>" class="form-control inputnum" placeholder="Phone Number">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="license_number" class="form-label">License Number</label>
                                <input type="text" name="license_number" value="<?php echo e(old('license_number', $driver->license_number)); ?>" class="form-control" placeholder="License Number">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                <input type="text" name="vehicle_type" value="<?php echo e(old('vehicle_type', $driver->vehicle_type)); ?>" class="form-control" placeholder="Vehicle Type">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" value="<?php echo e(old('date_of_birth', $driver->date_of_birth)); ?>" class="form-control">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="2" placeholder="Address"><?php echo e(old('address', $driver->address)); ?></textarea>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="A" <?php echo e($driver->status == 'A' ? 'selected' : ''); ?>>Active</option>
                                    <option value="D" <?php echo e($driver->status == 'D' ? 'selected' : ''); ?>>Inactive</option>
                                </select>
                            </div>
                        </div>

                       
                         <div class="row">
                            <div class="offset-md-4 col-md-3">
                                <a href="<?php echo e(route('admin.drivers')); ?>" class="btn d-grid btn-secondary">BACK</a>
                            </div>
                            <div class="col-md-3">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\logisticsApp\resources\views/admin/driver/edit.blade.php ENDPATH**/ ?>