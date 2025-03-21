
<div class="table-responsive">
  <!--begin::Table-->
  <table class="table table-centered table-nowrap mb-0">
    <!--begin::Table head-->
    <thead>
      <thead class="table-light">
        <th>Sl No.</th>
        <th>Name</th>    
        <th>Contact</th>
        <th>Wallet</th>
        <th>Status</th>		
        <th>DOJ</th>
        <th>Action</th>
    </thead>
    <tbody> 
      <?php $serial = $serial[0]; ?>
      <?php if($result->isNotEmpty()): ?>
        <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
      		<?php 
            $status = '<span class="badge bg-danger">Active</span>';
            if($row->status == 'D'){
              $status = '<span class="badge bg-danger">De-Active</span>';
            } 
      		?>
     
        <tr>
          <td><?php echo e($serial+$key); ?></td>           
          <td><?php echo $row->name.'<br/>('.$row->referral_code.')'; ?></td>           
          <td><?php echo $row->mobile .'<br/>'. $row->email; ?></td>          
          <td><?php echo '<i class="fa fa-inr"></i>'.$row->balance; ?></td> 
          <td><?php echo $status; ?></td> 		  
          <td><?php echo e(date('d M,Y H:i:s', strtotime($row->created_at))); ?></td> 
          <td>
            <a href="<?php echo e(route('admin.user.edit',['id'=>$row->id])); ?>" title="edit" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a> 			
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
</div><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/admin/user/table.blade.php ENDPATH**/ ?>