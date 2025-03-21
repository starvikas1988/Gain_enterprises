

<div class="table-responsive">
  <!--begin::Table-->
  <table class="table table-centered table-nowrap mb-0">
    <!--begin::Table head-->
    <thead>
      <thead class="table-light">
        <th>Sl No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Status</th>
        <th>Update At</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody> 
      <?php $serial = $serial[0]; ?>
      <?php if($result->isNotEmpty()): ?>
        <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <?php  
        $status = '<span class="badge badge-danger-lighten">Inactive</span>';
        if($row->status =='A') {
          $status = '<span class="badge badge-success-lighten">Active</span>'; 
        }
        ?>
        <tr>
          <td><?php echo e($serial+$key); ?></td>
          <td><?php echo e($row->name); ?></td>
          <td><?php echo e($row->email); ?></td>
          <td><?php echo e($row->mobile); ?></td>
          <td><?php echo $status; ?></td>
          <td><?php echo e(DATE("d M, Y", strtotime($row->updated_at))); ?></td>
          <td>
            <a href="<?php echo e(route('admin.restaurant.edit',['id'=>$row->id])); ?>" title="edit" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a> 
            <a href="<?php echo e(route('admin.restaurant.delete',['id'=>$row->id])); ?>" title="delete" class="action-icon" onclick="return myFunction();" ><i class="mdi mdi-trash-can"></i></a> 
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
        <tr>  
          <td colspan="10">No data found..</td>
        </tr>
      <?php endif; ?>
      
    </tbody>
    <!--end::Table body-->
  </table>
  <!--end::Table-->
  <div class="clearfix"><br/></div>
  <div align="left"><?php echo $result; ?></div>
</div><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/admin/restaurant/table.blade.php ENDPATH**/ ?>