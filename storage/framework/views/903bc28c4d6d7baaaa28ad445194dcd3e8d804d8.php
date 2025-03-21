

<?php $__env->startSection('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Add Resturant</li>
                </ol>
            </div>
            <h4 class="page-title">Add Resturant</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <p class="text-muted font-14">
                    <?php echo $__env->make('admin.include.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </p>

                <div class="tab-content">
                    <form action="<?php echo e(route('admin.restaurant.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                    
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" class="form-control" placeholder="Restaurant Name">
                            </div>
                    
                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?php echo e(old('email')); ?>" placeholder="Email">
                            </div>
                    
                            <!-- Mobile -->
                            <div class="col-md-6 mb-3">
                                <label for="mobile" class="form-label">Mobile</label>
                                <input type="text" id="mobile" name="mobile" class="form-control" value="<?php echo e(old('mobile')); ?>" placeholder="Mobile">
                            </div>
                    
                            <!-- Image Upload -->
                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" id="image" name="image" class="form-control">
                            </div>
                    
                            <!-- Rating -->
                            <div class="col-md-6 mb-3">
                                <label for="rating" class="form-label">Rating</label>
                                <input type="number" step="0.1" id="rating" name="rating" class="form-control" value="<?php echo e(old('rating', 4.1)); ?>" placeholder="Rating (e.g., 4.5)">
                            </div>
                    
                            <!-- Availability -->
                            <div class="col-md-6 mb-3">
                                <label for="availability" class="form-label">Availability</label>
                                <select class="form-select" name="availability" id="availability">
                                    <option value="OPEN" <?php echo e(old('availability') == 'OPEN' ? 'selected' : ''); ?>>OPEN</option>
                                    <option value="CLOSE" <?php echo e(old('availability') == 'CLOSE' ? 'selected' : ''); ?>>CLOSE</option>
                                </select>
                            </div>
                    
                            <!-- GST Percentage -->
                            <div class="col-md-6 mb-3">
                                <label for="gst_percentage" class="form-label">GST Percentage</label>
                                <input type="number" id="gst_percentage" name="gst_percentage" class="form-control" value="<?php echo e(old('gst_percentage')); ?>" placeholder="GST %">
                            </div>
                    
                            <!-- GST Type -->
                            <div class="col-md-6 mb-3">
                                <label for="gst_type" class="form-label">GST Type</label>
                                <select class="form-select" name="gst_type">
                                    <option value="Including" <?php echo e(old('gst_type') == 'Including' ? 'selected' : ''); ?>>Including</option>
                                    <option value="Excluding" <?php echo e(old('gst_type') == 'Excluding' ? 'selected' : ''); ?>>Excluding</option>
                                </select>
                            </div>
                    
                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="A" <?php echo e(old('status') == 'A' ? 'selected' : ''); ?>>Active</option>
                                    <option value="D" <?php echo e(old('status') == 'D' ? 'selected' : ''); ?>>Disabled</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control" value="<?php echo e(old('password')); ?>" placeholder="Enter Password">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Re-enter Password">
                            </div>
                    
                            <!-- Address -->
                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea id="address" name="address" class="form-control" placeholder="Address"><?php echo e(old('address')); ?></textarea>
                            </div>
                    
                        </div>
                    
                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit" class="btn d-grid btn-primary">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                                        
                    </div> <!-- end preview-->
                </div> <!-- end tab-content-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/admin/restaurant/create.blade.php ENDPATH**/ ?>