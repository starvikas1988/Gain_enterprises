

<?php $__env->startSection('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.users')); ?>">Customer</a></li>
                    <li class="breadcrumb-item active">Add Customer</li>
                </ol>
            </div>
            <h4 class="page-title">Add Customer</h4>
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
                        <form accept="<?php echo e(route('admin.user.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label for="simpleinput1" class="form-label">Name</label>
                                    <input type="text" id="simpleinput1" name="name" value="<?php echo e(old('name')); ?>" class="form-control" placeholder="Name">
                                </div>   
								<div class="col-md-4 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" placeholder="Email">
                                </div>   
								<div class="col-md-4 mb-3">
                                    <label for="mobile" class="form-label">Mobile Number</label>
                                    <input type="text" id="mobile" name="mobile" value="<?php echo e(old('mobile')); ?>" class="form-control inputnum" placeholder="Mobile Number">
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-offset-8 col-md-4">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/admin/user/create.blade.php ENDPATH**/ ?>