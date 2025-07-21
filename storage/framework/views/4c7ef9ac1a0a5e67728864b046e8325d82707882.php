

<?php $__env->startSection('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.drivers')); ?>">Driver</a></li>
                    <li class="breadcrumb-item active">Add Driver</li>
                </ol>
            </div>
            <h4 class="page-title">Add Driver</h4>
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
                    <form action="<?php echo e(route('admin.driver.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" class="form-control" placeholder="Name">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" placeholder="Email">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" id="phone" name="phone" value="<?php echo e(old('phone')); ?>" class="form-control inputnum" placeholder="Phone Number">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="license_number" class="form-label">License Number</label>
                                <input type="text" id="license_number" name="license_number" value="<?php echo e(old('license_number')); ?>" class="form-control" placeholder="License Number">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                <input type="text" id="vehicle_type" name="vehicle_type" value="<?php echo e(old('vehicle_type')); ?>" class="form-control" placeholder="Vehicle Type">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo e(old('date_of_birth')); ?>" class="form-control">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea id="address" name="address" class="form-control" rows="2" placeholder="Address"><?php echo e(old('address')); ?></textarea>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\logisticsApp\resources\views/admin/driver/create.blade.php ENDPATH**/ ?>