

<?php $__env->startSection('content'); ?>
<!-- start page title -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Resturant List</li>
                </ol>
            </div>
            <h4 class="page-title">Resturant List</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-xl-3">
                        <label for="inputPassword2" class="visually-hidden">Search</label>
                        <input type="search" class="form-control" id="s_key" placeholder="Name, Email...">
                    </div>
                    <div class="col-xl-3">
                        <select class="form-select" id="s_stat">
                            <option value="">Choose...</option>
                            <option value="A">Active</option>
                            <option value="D">Inactive</option>
                        </select>
                    </div>
                    <div class="col-xl-3">
                        <div class="mb-3 position-relative" id="datepicker4">
                            <input type="text" class="form-control" id="s_date" data-provide="datepicker" data-date-autoclose="true" data-date-container="#datepicker4">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="text-xl-end mt-xl-0 mt-2">
                            <a href="<?php echo e(route('admin.restaurant.create')); ?>" class="btn btn-danger mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add Resturant</a>
                        </div>
                    </div><!-- end col-->
                </div>
                <div class="row"><p class="text-muted font-14"><?php echo $__env->make('admin.include.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></p></div>
                <div class="row">
                    <div id="data_table"></div>
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    var current_url='';
    data_table(page_url=false);
    $('#s_key').keyup(function(event){
        event.preventDefault();
        data_table(page_url=false);
    });
    $('#s_stat').change(function(event){
        event.preventDefault();
        data_table(page_url=false);
    });
    $('#s_date').change(function(event){
        event.preventDefault();
        data_table(page_url=false);
    });
    $(document).on('click','.pagination li a',function(event){
        event.preventDefault();
        var page_url = $(this).attr('href');
        current_url = page_url;
        data_table(page_url);
    });

    function data_table(page_url){
        var skey = $('#s_key').val();
        var sstat = $('#s_stat').val();
        var sdate = $('#s_date').val();
        var base_url = '<?php echo e(route("admin.restaurant")); ?>';
        console.log(skey);
        if(page_url)
        {
            base_url = page_url;
            current_url = page_url;
        }
        $.ajax({
            url: base_url,
            type:'GET',
            dataType:'html',
            data:{skey:skey,sstat:sstat,sdate:sdate,"_token": "<?php echo e(csrf_token()); ?>"},
            success:function(resp){
                console.log(resp);
                $('#data_table').html(resp);
            }
        });
    }
    $(window).focus(function() {
        data_table(page_url);
    });
    
</script>
<script>
  function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }
 </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/admin/restaurant/header.blade.php ENDPATH**/ ?>