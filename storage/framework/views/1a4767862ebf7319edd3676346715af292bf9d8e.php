

<?php $__env->startSection('content'); ?>

<!-- Start Page Title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.restaurant')); ?>">Restaurants</a></li>
                    <li class="breadcrumb-item active">Edit Restaurant</li>
                </ol>
            </div>
            <h4 class="page-title">Edit Restaurant</h4>
        </div>
    </div>
</div>
<!-- End Page Title -->

<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <p class="text-muted font-14">
                    <?php echo $__env->make('admin.include.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </p>

                <form action="<?php echo e(route('admin.restaurant.update', $restaurant->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    
                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" value="<?php echo e(old('name', $restaurant->name)); ?>" class="form-control" placeholder="Restaurant Name">
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo e(old('email', $restaurant->email)); ?>" placeholder="Email">
                        </div>

                        <!-- Mobile -->
                        <div class="col-md-6 mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" id="mobile" name="mobile" class="form-control" value="<?php echo e(old('mobile', $restaurant->mobile)); ?>" placeholder="Mobile">
                        </div>

                        <!-- Image Upload -->
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" id="image" name="image" class="form-control">
                            <?php if($restaurant->image): ?>
                            <img src="<?php echo e(asset($restaurant->image)); ?>" alt="Restaurant Image" width="100">

                            <?php endif; ?>
                        </div>

                        <!-- Rating -->
                        <div class="col-md-6 mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="number" step="0.1" id="rating" name="rating" class="form-control" value="<?php echo e(old('rating', $restaurant->rating)); ?>" placeholder="Rating (e.g., 4.5)">
                        </div>

                        <!-- Availability -->
                        <div class="col-md-6 mb-3">
                            <label for="availability" class="form-label">Availability</label>
                            <select class="form-select" name="availability">
                                <option value="OPEN" <?php echo e($restaurant->availability == 'OPEN' ? 'selected' : ''); ?>>OPEN</option>
                                <option value="CLOSE" <?php echo e($restaurant->availability == 'CLOSE' ? 'selected' : ''); ?>>CLOSE</option>
                            </select>
                        </div>

                        <!-- GST Percentage -->
                        <div class="col-md-6 mb-3">
                            <label for="gst_percentage" class="form-label">GST Percentage</label>
                            <input type="number" id="gst_percentage" name="gst_percentage" class="form-control" value="<?php echo e(old('gst_percentage', $restaurant->gst_percentage)); ?>" placeholder="GST %">
                        </div>

                        <!-- GST Type -->
                        <div class="col-md-6 mb-3">
                            <label for="gst_type" class="form-label">GST Type</label>
                            <select class="form-select" name="gst_type">
                                <option value="Including" <?php echo e($restaurant->gst_type == 'Including' ? 'selected' : ''); ?>>Including</option>
                                <option value="Excluding" <?php echo e($restaurant->gst_type == 'Excluding' ? 'selected' : ''); ?>>Excluding</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="A" <?php echo e($restaurant->status == 'A' ? 'selected' : ''); ?>>Active</option>
                                <option value="D" <?php echo e($restaurant->status == 'D' ? 'selected' : ''); ?>>Disabled</option>
                            </select>
                        </div>
                        <!-- Password (Leave empty if not changing) -->
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password (leave blank for current password)">
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Re-enter new password">
                        </div>


                        <!-- Address -->
                        <div class="col-md-12 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea id="address" name="address" class="form-control" placeholder="Address"><?php echo e(old('address', $restaurant->address)); ?></textarea>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn d-grid btn-primary">UPDATE</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/admin/restaurant/edit.blade.php ENDPATH**/ ?>