

<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <h2 class="mb-4">Stock Management</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="mb-4 d-flex justify-content-between">
        <a href="<?php echo e(route('employee.stocks.create')); ?>" class="btn btn-primary">Add Stock</a>
        <a href="<?php echo e(route('employee.stocks.downloadSample')); ?>" class="btn btn-success">Download Sample Excel</a>
    </div>

    <form action="<?php echo e(route('employee.stocks.uploadBulk')); ?>" method="POST" enctype="multipart/form-data" class="mb-4">
        <?php echo csrf_field(); ?>
        <label for="file" class="form-label">Upload Stock File (Excel)</label>
        <input type="file" name="file" id="file" class="form-control" accept=".xlsx, .csv" required>
        <button type="submit" class="btn btn-primary mt-2">Upload & Update Stock</button>
    </form>

    <!-- Stocks Table Section with Editable Fields -->
    <form action="<?php echo e(route('employee.stocks.updateBulk')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th>Default Stock</th>
                    <th>Today's Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($stock->id); ?></td>
                    <td><?php echo e(optional($stock->category)->name ?? 'N/A'); ?></td>
                    <td><?php echo e(optional($stock->product)->name ?? 'N/A'); ?></td>
                    
                    <!-- Editable Default Stock -->
                    <td>
                        <input type="number" name="stocks[<?php echo e($stock->id); ?>][default_stock]" class="form-control" value="<?php echo e($stock->default_stock); ?>" min="0">
                    </td>

                    <!-- Editable Today's Stock with Conditional Display -->
                    <td>
                        <?php
                            $today = \Carbon\Carbon::today();
                            $isToday = ($stock->updated_at && $stock->updated_at->isToday()) 
                                        || (!$stock->updated_at && $stock->created_at->isToday());
                        ?>
                        
                        <input type="number" 
                               name="stocks[<?php echo e($stock->id); ?>][todays_stock]" 
                               class="form-control" 
                               value="<?php echo e($isToday ? $stock->todays_stock : ''); ?>" 
                               min="0" 
                               placeholder="<?php echo e($isToday ? '' : 'Enter Today\'s Stock'); ?>">
                    </td>

                    <td>
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo e($stock->id); ?>)">Delete</button>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center">No Stocks Available</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </form>

    <!-- Delete Form (Hidden) -->
    <form id="deleteForm" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
    </form>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        <?php echo e($stocks->links()); ?>

    </div>
</div>

<script>
    function confirmDelete(stockId) {
        if (confirm('Are you sure you want to delete this stock?')) {
            const form = document.getElementById('deleteForm');
            form.action = `/employee/stocks/${stockId}`;
            form.submit();
        }
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.employee', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/employee/stocks/index.blade.php ENDPATH**/ ?>