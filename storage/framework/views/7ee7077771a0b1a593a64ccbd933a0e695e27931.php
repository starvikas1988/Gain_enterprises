

<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <h2 class="mb-4">Create New Stock</h2>

    <!-- Back to Stock Management -->
    <a href="<?php echo e(route('restaurant.stocks.index')); ?>" class="btn btn-secondary mb-3">Back to Stocks</a>

    <!-- Stock Creation Form -->
    <form action="<?php echo e(route('restaurant.stocks.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        
        <div class="row">
            <!-- Category Selection -->
            <div class="col-md-6 mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">Select Category</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Product Selection (Populated Based on Category) -->
            <div class="col-md-6 mb-3">
                <label for="product_id" class="form-label">Product</label>
                <select name="product_id" id="product_id" class="form-select" required>
                    <option value="">Select Product</option>
                </select>
            </div>

            <!-- Default Stock -->
            <div class="col-md-6 mb-3">
                <label for="default_stock" class="form-label">Default Stock</label>
                <input type="number" name="default_stock" id="default_stock" class="form-control" value="100" min="0" required>
            </div>

            <!-- Today's Stock -->
            <div class="col-md-6 mb-3">
                <label for="todays_stock" class="form-label">Today's Stock</label>
                <input type="number" name="todays_stock" id="todays_stock" class="form-control" value="0" min="0" required>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Stock</button>
    </form>
</div>

<!-- JavaScript for Dynamic Product Selection -->
<script>
   document.getElementById('category_id').addEventListener('change', function () {
    const categoryId = this.value;
    const productSelect = document.getElementById('product_id');

    if (categoryId) {
        fetch(`/restaurant/stocks/products/${categoryId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                productSelect.innerHTML = '<option value="">Select Product</option>';
                data.forEach(product => {
                    productSelect.innerHTML += `<option value="${product.id}">${product.name}</option>`;
                });
            })
            .catch(error => {
                console.error('Error fetching products:', error);
            });
    } else {
        productSelect.innerHTML = '<option value="">Select Product</option>';
    }
});

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.restaurant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/restaurant/stocks/create.blade.php ENDPATH**/ ?>