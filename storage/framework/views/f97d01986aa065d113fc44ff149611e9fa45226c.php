

<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <div class="mb-4 p-3 bg-light border rounded">
        <h4 class="mb-0">Restaurant: <?php echo e(Auth::user()->name); ?></h4>
    </div>
    <h2 class="mb-4">Table Management</h2>
    <a href="<?php echo e(route('restaurant.tables.create')); ?>" class="btn btn-primary mb-3">Add New Table</a>

    <!-- Filter Section -->
    <form method="GET" action="<?php echo e(route('restaurant.tables.index')); ?>" class="mb-4">
        <div class="row">
            <!-- Search by Order ID -->
            <div class="col-md-3">
                <label for="table_id" class="form-label">Table ID</label>
                <input type="text" name="table_id" id="table_id" class="form-control" placeholder="Search by Table ID" value="<?php echo e(request('table_id')); ?>">
            </div>

            <!-- Search by Status -->
            <div class="col-md-3">
                <label for="table_status" class="form-label">Table Status</label>
                <select name="table_status" id="table_status" class="form-select">
                    <option value="">All</option>
                    <option value="Available" <?php echo e(request('table_status') == 'Available' ? 'selected' : ''); ?>>Available</option>
                    <option value="Occupied" <?php echo e(request('table_status') == 'Occupied' ? 'selected' : ''); ?>>Occupied</option>
                    <option value="Reserved" <?php echo e(request('table_status') == 'Reserved' ? 'selected' : ''); ?>>Reserved</option>
                </select>
            </div>

            <!-- Search by Date -->
            <div class="col-md-3">
                <label for="date" class="form-label">Created Date</label>
                <input type="date" name="date" id="date" class="form-control" value="<?php echo e(request('date')); ?>">
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="<?php echo e(route('restaurant.tables.index')); ?>" class="btn btn-secondary ms-2">Reset</a>
            </div>
        </div>
    </form>

    <!-- Orders Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Table ID</th>
                    <th>Table Name</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($table->id); ?></td>
                        <td><?php echo e($table->table_number); ?></td>
                        <td><?php echo e($table->capacity); ?></td>
                        <td><?php echo e($table->status); ?></td>
                        <td><?php echo e($table->created_at->format('d M Y, h:i A')); ?></td>
                        <td>
                            <a href="<?php echo e(route('restaurant.tables.edit', $table->id)); ?>" class="btn btn-info btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm delete-table" data-id="<?php echo e($table->id); ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center">No Orders Found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        <?php echo e($tables->links()); ?>

    </div>

</div>

<!-- Order Details Modal -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Table Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="orderDetailsContent">
                <!-- Order details will load here using Ajax -->
                <p>Loading...</p>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

    $('.view-order').click(function () {
        const tableId = $(this).data('id');

        $('#orderDetailsContent').html('<p>Loading order details...</p>');
        $('#orderDetailsModal').modal('show');

        // AJAX call to fetch order details
        $.ajax({
            url: `/restaurant/tables/${tableId}`,
            method: 'GET',
            success: function (response) {
                $('#orderDetailsContent').html(response);
            },
            error: function () {
                $('#orderDetailsContent').html('<p class="text-danger">Failed to load order details.</p>');
            }
        });
    });
    // Delete Order - AJAX with Confirmation
        $('.delete-table').click(function () {
            const tableId = $(this).data('id');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (confirm('Are you sure you want to delete this table? This action is irreversible.')) {
                $.ajax({
                    url: `/restaurant/tables/${tableId}`,
                    method: 'POST', // Send it as POST
                    data: {
                        _token: csrfToken,
                        _method: 'DELETE' // Laravel understands this as DELETE using method spoofing
                    },
                    success: function (response) {
                       // alert(response.message);
                        location.reload();
                    },
                    error: function (xhr) {
                        alert('Failed to delete the table. Error: ' + (xhr.responseJSON?.message || 'Unknown error'));
                    }
                });

            }
        });

    });


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.restaurant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/Restaurant/tables/index.blade.php ENDPATH**/ ?>