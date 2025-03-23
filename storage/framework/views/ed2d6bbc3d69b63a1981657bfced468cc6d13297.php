

<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <div class="mb-4 p-3 bg-light border rounded">
        <h4 class="mb-0">Restaurant: <?php echo e(Auth::user()->name); ?></h4>
    </div>
    <h2 class="mb-4">Product Management</h2>
    
    <a href="<?php echo e(route('restaurant.products.create')); ?>" class="btn btn-primary mb-3">Add New Product</a>

    <!-- Filter Section -->
    <form method="GET" action="<?php echo e(route('restaurant.products.index')); ?>" class="mb-4">
        <div class="row">
            <!-- Search by Product Name -->
            <div class="col-md-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Search by Product Name" value="<?php echo e(request('name')); ?>">
            </div>

            <!-- Search by Category -->
            <div class="col-md-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="">All Categories</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Search by Status -->
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">All</option>
                    <option value="A" <?php echo e(request('status') == 'A' ? 'selected' : ''); ?>>Active</option>
                    <option value="D" <?php echo e(request('status') == 'D' ? 'selected' : ''); ?>>Deactivated</option>
                </select>
            </div>

            <!-- Search by Date -->
            <div class="col-md-3">
                <label for="date" class="form-label">Created Date</label>
                <input type="date" name="date" id="date" class="form-control" value="<?php echo e(request('date')); ?>">
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="<?php echo e(route('restaurant.products.index')); ?>" class="btn btn-secondary ms-2">Reset</a>
            </div>
        </div>
    </form>

    <!-- Products Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Recommend</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($product->id); ?></td>
                        <td><?php echo e($product->name); ?></td>
                        <td><?php echo e($product->category->name); ?></td>
                        <td>₹<?php echo e(number_format($product->price, 2)); ?></td>
                        <td>
                            <?php if($product->image): ?>
                                
                                <img src="<?php echo e('/uploads/product/' . basename($product->image)); ?>" alt="icon" width="50" height="50">
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($product->is_recommend === 'YES' ? 'Yes' : 'No'); ?></td>
                        <td><?php echo e($product->status == 'A' ? 'Active' : 'Deactivated'); ?></td>
                        <td><?php echo e($product->created_at->format('d M Y, h:i A')); ?></td>
                        <td>
                            <a href="<?php echo e(route('restaurant.products.edit', $product->id)); ?>" class="btn btn-info btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm delete-product" data-id="<?php echo e($product->id); ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="text-center">No Products Found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        <?php echo e($products->links()); ?>

    </div>
</div>

<script>
    $(document).ready(function () {
        $('.delete-product').click(function () {
            const productId = $(this).data('id');
            const csrfToken = "<?php echo e(csrf_token()); ?>";

            if (confirm('Are you sure you want to delete this product? This action is irreversible.')) {
                $.ajax({
                    url: `/restaurant/products/${productId}`,
                    method: 'POST',
                    data: {
                        _token: csrfToken,
                        _method: 'DELETE'
                    },
                    success: function (response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function (xhr) {
                        alert('Failed to delete the product. Error: ' + (xhr.responseJSON?.message || 'Unknown error'));
                    }
                });
            }
        });
    });

    $(document).ready(function () {
            $('#status').select2();
        });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.restaurant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/Restaurant/products/index.blade.php ENDPATH**/ ?>