

<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <h2 class="mb-4">Stock Management</h2>

    <!-- Bulk Upload Form Section -->
    <div class="mb-4 p-3 bg-light border rounded">
        <h5 class="mb-3">Upload Stock Data (Excel)</h5>

        <!-- Download Sample Excel -->
        <a href="<?php echo e(route('restaurant.stocks.downloadSample')); ?>" class="btn btn-success mb-3">Download Sample Excel</a>

        <!-- Upload Form -->
        <form action="<?php echo e(route('restaurant.stocks.uploadBulk')); ?>" method="POST" enctype="multipart/form-data" class="mb-4">
            <?php echo csrf_field(); ?>
            <label for="file" class="form-label">Upload Stock File (Excel)</label>
            <input type="file" name="file" id="file" class="form-control" accept=".xlsx, .csv" required>
            <button type="submit" class="btn btn-primary mt-2">Upload & Update Stock</button>
            
        </form>
        
    </div>

    <!-- Stocks Table Section with Editable Fields -->
    <form action="<?php echo e(route('restaurant.stocks.updateBulk')); ?>" method="POST">
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
                    <td><?php echo e($stock->category->name); ?></td>
                    <td><?php echo e($stock->product->name); ?></td>
                    
                    <!-- Editable Default Stock -->
                    <td>
                        <input type="number" name="stocks[<?php echo e($stock->id); ?>][default_stock]" class="form-control" value="<?php echo e($stock->default_stock); ?>" min="0">
                    </td>

                    <!-- Editable Today's Stock -->
                    <td>
                        <input type="number" name="stocks[<?php echo e($stock->id); ?>][todays_stock]" class="form-control" value="<?php echo e($stock->todays_stock); ?>" min="0">
                    </td>

                    <td>
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                         <!-- Delete Button -->
                         <form action="<?php echo e(route('restaurant.stocks.destroy', $stock->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this stock?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
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

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        <?php echo e($stocks->links()); ?>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.restaurant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/Restaurant/stocks/index.blade.php ENDPATH**/ ?>