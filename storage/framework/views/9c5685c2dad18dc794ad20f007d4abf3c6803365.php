

<?php $__env->startSection('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<?php
    $users = App\Models\Driver::count();
?>

<div class="row">
    <div class="col-xl-12 col-lg-12">

        <div class="row">
			
            <div class="col-sm-3">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-account-multiple widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Total Drivers</h5>
                        <h3 class="mt-3 mb-3"><?php echo e($users); ?></h3>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->    
            
			
        </div> <!-- end row -->
    </div> <!-- end col -->
</div>
<!-- end row -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\logisticsApp\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>