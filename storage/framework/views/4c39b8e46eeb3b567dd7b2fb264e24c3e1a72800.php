<style>
  .btn-sm {
    padding: 4px 8px;
    font-size: 13px;
  }

  .btn-outline-primary:hover,
  .btn-outline-danger:hover,
  .btn-outline-info:hover {
    color: #fff !important;
  }
</style>

<div class="table-responsive">
  <!--begin::Table-->
  <table class="table table-centered table-nowrap mb-0">
    <!--begin::Table head-->
    <thead class="table-light">
      <tr>
        <th>Sl No.</th>
        <th>Route Name</th>
        <th>Driver</th>
        <th>Type</th>
        <th>Stores (Stops)</th>
        <th>Created At</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $serial = $serial[0]; ?>
      <?php if($result->isNotEmpty()): ?>
        <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($serial + $key); ?></td>
            <td><?php echo e($row->name); ?></td>
            <td><?php echo e($row->driver->name ?? 'N/A'); ?></td>
            <td>
              <?php if($row->type === 'linear'): ?>
                <span class="badge bg-primary">Linear</span>
              <?php else: ?>
                <span class="badge bg-warning">Circular</span>
              <?php endif; ?>
            </td>
            <td>
              <?php $__currentLoopData = $row->stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($store->name); ?><?php if(!$loop->last): ?> → <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td><?php echo e(date('d M, Y H:i:s', strtotime($row->created_at))); ?></td>

            <td class="d-flex gap-2">
              
              <a href="<?php echo e(route('admin.drive_route.edit', ['id' => $row->id])); ?>"
                 class="btn btn-sm btn-outline-primary"
                 title="Edit">
                <i class="mdi mdi-pencil"></i>
              </a>

              
              <a href="<?php echo e(route('admin.drive_route.show', ['id' => $row->id])); ?>"
                 class="btn btn-sm btn-outline-info"
                 title="View">
                <i class="mdi mdi-eye"></i>
              </a>

              
              <a href="<?php echo e(route('admin.drive_route.delete', ['id' => $row->id])); ?>"
                 class="btn btn-sm btn-outline-danger"
                 title="Delete"
                 onclick="return confirm('Are you sure you want to delete this route?');">
                <i class="mdi mdi-delete"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
        <tr>
          <td colspan="7">No routes found..</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
  <!--end::Table-->
  <div class="clearfix"><br/></div>
  <div align="left"><?php echo $result; ?></div>
</div>
<?php /**PATH C:\xampp\htdocs\logisticsApp\resources\views/admin/drive_route/table.blade.php ENDPATH**/ ?>