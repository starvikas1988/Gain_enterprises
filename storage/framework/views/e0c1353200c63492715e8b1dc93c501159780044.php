


<?php $__env->startSection('content'); ?>
<?php
    $employee = auth()->guard('employee')->user();
    $restaurantId = $employee->restaurant_id;
    $restaurant = DB::table('restaurants')->where('id', $restaurantId)->first();
?>
<div class="container mt-4">
    <div class="mb-4 p-3 bg-light border rounded">
        <h4 class="mb-0">Restaurant: <?php echo e($restaurant->name); ?></h4>
    </div>
    <h2 class="mb-4">Category Management</h2>
    
    <a href="<?php echo e(route('employee.categories.create')); ?>" class="btn btn-primary mb-3">Add New Category</a>

    <!-- Filter Section -->
    <form method="GET" action="<?php echo e(route('employee.categories.index')); ?>" class="mb-4">
        <div class="row">
            <!-- Search by Name -->
            <div class="col-md-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Search by Category Name" value="<?php echo e(request('name')); ?>">
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
                <a href="<?php echo e(route('employee.categories.index')); ?>" class="btn btn-secondary ms-2">Reset</a>
            </div>
        </div>
    </form>

    <!-- Categories Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
               
                    <tr>
                        <td><?php echo e($category->id); ?></td>
                        <td><?php echo e($category->name); ?></td>
                        <td>
                            <?php if($category->icon): ?>
                                 
                                <img src="<?php echo e('/uploads/category/' . basename($category->icon)); ?>" alt="icon" width="50" height="50">

                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($category->status == 'A' ? 'Active' : 'Deactivated'); ?></td>
                        <td><?php echo e($category->created_at->format('d M Y, h:i A')); ?></td>
                        <td>
                            <a href="<?php echo e(route('employee.categories.edit', $category->id)); ?>" class="btn btn-info btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm delete-category" data-id="<?php echo e($category->id); ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center">No Categories Found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        <?php echo e($categories->links()); ?>

    </div>
</div>

<script>
    $(document).ready(function () {
        $('.delete-category').click(function () {
            const categoryId = $(this).data('id');
            const csrfToken = "<?php echo e(csrf_token()); ?>";

            if (confirm('Are you sure you want to delete this category? This action is irreversible.')) {
                $.ajax({
                    url: `/employee/categories/${categoryId}`,
                    method: 'POST',
                    xhrFields: { withCredentials: true },
                    data: {
                        _token: csrfToken,
                        _method: 'DELETE'
                    },
                    success: function (response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function (xhr) {
                        alert('Failed to delete the category. Error: ' + (xhr.responseJSON?.message || 'Unknown error'));
                    }
                });
            }
        });

        $(document).ready(function () {
            $('#status').select2();
        });

    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.employee', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/Employee/categories/index.blade.php ENDPATH**/ ?>