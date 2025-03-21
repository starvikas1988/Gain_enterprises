

<?php $__env->startSection('content'); ?>
<style>
    body {
        background: #e8eaf6;
    }
    .pos-container {
        display: flex;
        padding: 20px;
        gap: 20px;
    }
    .left-panel {
        width: 65%;
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
    }
    .right-panel {
        width: 35%;
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        height: 80vh;
    }
    .product-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: space-between;
    }
    .product-card {
        width: 48%;
        padding: 10px;
        background: #d5f5d1;
        border-radius: 8px;
        cursor: pointer;
        text-align: center;
    }
    .product-card img {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
    }
    .cart-table {
        width: 100%;
    }
    .cart-table th, .cart-table td {
        padding: 8px;
        text-align: center;
    }
    .cart-table input {
        width: 50px;
        text-align: center;
    }
    .cart-footer {
        display: flex;
        justify-content: space-between;
        padding-top: 10px;
    }
    .btn-pos {
        width: 100px;
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
    }
    .input-group {
    width: 120px;
    }

    .qty-input {
        width: 50px;
        border: none;
    }

    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        background-color: #fff;
        border: 1px solid #ccc;
        z-index: 1000;
    }

    .ui-menu-item {
        padding: 10px;
        cursor: pointer;
    }

    .ui-state-active {
        background-color: #007bff;
        color: white;
    }


</style>
    <div class="container">
        <h2>KOT (Kitchen Order Tickets)</h2>
        

        <div class="pos-container">
            <!-- Left Panel (Cart) -->
            <div class="left-panel">
                <h5>Cart</h5>
                <table class="table cart-table">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody id="cart-body">
                        <!-- Items will be added dynamically -->
                    </tbody>
                </table>
                <div class="cart-footer">
                    <button class="btn btn-danger btn-pos">Cancel</button>
                    
                    <button id="openPaymentModal" class="btn btn-success btn-pos">Pay</button>
                    
                </div>
            </div>
    
            <!-- Right Panel (Product List) -->
            <div class="right-panel">
                <h5>Order Type</h5>
                <div class="mb-3">
                    <label for="orderTypeSelect" class="form-label">Select Order Type:</label>
                    <select id="orderTypeSelect" class="form-select">
                        <option value="">-- Select--</option> 
                        <?php $__currentLoopData = $orderTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($orderType->name); ?>" data-name="<?php echo e($orderType->name); ?>"><?php echo e($orderType->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3" id="tableNumberContainer" style="display: none;">
                    <label for="tableNumberSelect" class="form-label">Select Table Number:</label>
                    <select id="tableNumberSelect" class="form-select">
                        <option value="">-- Select Table --</option>
                        <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($table->id); ?>"><?php echo e($table->table_number); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <h5>Products</h5>
                 <!-- Category Selection -->
                    <div class="mb-3">
                        <label for="categorySelect" class="form-label">Select Category:</label>
                        <select id="categorySelect" class="form-select">
                            <option value="all">-- All Categories --</option> 
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                     <!-- Product Search Bar -->
                    <div class="mb-3">
                        <label for="productSearch" class="form-label">Search Product:</label>
                        <input type="text" id="productSearch" class="form-control" placeholder="Search by product name...">
                    </div>

                    <div class="product-list" id="productContainer">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="product-card"  data-product-id="<?php echo e($product->id); ?>" 
                             data-name="<?php echo e($product->name); ?>" data-price="<?php echo e($product->price); ?>">
                            
                            <img src="<?php echo e($product->image ?? 'https://via.placeholder.com/80'); ?>" alt="Product">
                            <p><?php echo e($product->name); ?></p>
                            <strong>₹<?php echo e($product->price); ?></strong>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="paymentModalLabel">Payments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modalMessage" class="m-3"></div>
                <div class="modal-body">
                    <div class="container">

                        <!-- Discount & Coupon Section -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Discount Coupon Code</label>
                                <input type="text" class="form-control" id="couponCode">
                                <span id="couponError" style="display: none; background: #f39c12 ; color: white; padding: 5px; font-size: 12px; border-radius: 3px; margin-top: 5px; display: block;"></span>
                            </div>
                            <div class="col-md-6">
                                <label>Coupon Type:</label> <span id="couponType">N/A</span>
                                <br>
                                <strong>Coupon Value: ₹<span id="couponValue">0.00</span></strong>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="row p-3 mb-3 shadow-sm rounded" style="background-color: #e9ecef;">
                            
                            <div class="col-md-12 mt-2">
                                <label>Account</label>
                                <select class="form-control" id="paymentAccount">
                                    <option>-Select-</option>
                                    <option value="cash">Cash</option>
                                    <option value="upi">UPI</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label>Payment Note</label>
                                <textarea class="form-control" id="paymentNote"></textarea>
                            </div>
                        </div>

                        <!-- Summary Details -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bg-primary text-white p-2 rounded mb-1"><strong>Total Items:</strong> <span id="totalItems">1</span></div>
                                <div class="bg-info text-white p-2 rounded mb-1"><strong>Total:</strong> ₹<span id="totalAmount">0.00</span></div>
                                <div class="bg-warning p-2 rounded mb-1"><strong>Discount(-):</strong> ₹<span id="discountAmount">0.00</span></div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-danger text-white p-2 rounded mb-1"><strong>Total Payable:</strong> ₹<span id="totalPayable">0.00</span></div>
                                <div class="bg-success text-white p-2 rounded mb-1"><strong>Total Paying:</strong> ₹<span id="totalPaying">0.00</span></div>
                                <div class="bg-secondary text-white p-2 rounded mb-1"><strong>Balance:</strong> ₹<span id="balanceAmount">0.00</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="cartData" name="cartData">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="saveOrder">Save</button>
                    
                </div>
            </div>
        </div>
    </div>


    <script>
       $(document).ready(function () {
        document.getElementById('orderTypeSelect').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const orderTypeName = selectedOption.getAttribute('data-name');

        if (orderTypeName === 'Dine-in') {
            document.getElementById('tableNumberContainer').style.display = 'block';
        } else {
            document.getElementById('tableNumberContainer').style.display = 'none';
        }
    });

    $('#categorySelect').change(function () {
        let categoryId = $(this).val();
        if (categoryId === "all") {
            location.reload(); // Reload the page to reset to initial state
            return;
        }
        if (categoryId) {
            $.ajax({
                url: "<?php echo e(route('restaurant.getProducts')); ?>",
                type: "POST",
                data: {
                    category_id: categoryId,
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function (response) {
                    let productHtml = '';
                    if (response.length > 0) {
                        response.forEach(product => {
                            productHtml += `
                                <div class="product-card"   data-product-id="${product.id}" 
                      data-name="${product.name}"  data-price="${product.price}">
                                   
                                    <img src="${product.image ?? 'https://via.placeholder.com/80'}" alt="Product">
                                    <p>${product.name}</p>
                                    <strong>₹${product.price}</strong>
                                </div>
                            `;
                        });
                    } else {
                        productHtml = "<p>No products found.</p>";
                    }
                    $('#productContainer').html(productHtml);
                }
            });
        } else {
            $('#productContainer').html(""); // Clear products if no category selected
        }
    });
    //  <span class="badge bg-danger">Qty: ${product.stock}</span>
    // Fix: Use event delegation for dynamically added elements
    $(document).on("click", ".product-card", function () {
        let name = $(this).data("name");
        //let stock = $(this).data("stock");
        let price = $(this).data("price");
        let productId = $(this).data("product-id");

        //let existingRow = $("#cart-body").find("tr[data-name='" + name + "']");
        
        let existingRow = $("#cart-body").find(`tr[data-product-id='${productId}']`);

        if (existingRow.length > 0) {
            let qtyInput = existingRow.find(".qty-input");
            let newQty = parseInt(qtyInput.val()) + 1;
            qtyInput.val(newQty);
        } else {
            let newRow = `<tr data-product-id="${productId}">
                <td>${name}</td>
                  <td>
                <div class="input-group">
                    <button class="btn btn-outline-danger decrement-btn">-</button>
                    <input type="text" class="qty-input form-control text-center" value="1" min="1" readonly>
                    <button class="btn btn-outline-success increment-btn">+</button>
                </div>
            </td>
                <td><input type="number" class="qty-input" value="1" min="1"></td>
                <td>₹${price}</td>
                <td class="subtotal">₹${price}</td>
                <td><button class="btn btn-sm btn-danger remove-btn"><i class="fa fa-trash"></i></button></td>
            </tr>`;
            $("#cart-body").append(newRow);
        }

        updateTotal(); // Update total after adding item
        togglePayButton();
    });

    $(document).on("click", ".increment-btn", function () {
    let qtyInput = $(this).siblings(".qty-input");
    let newQty = parseInt(qtyInput.val()) + 1;
    qtyInput.val(newQty);
    updateSubtotal(qtyInput);
});

$(document).on("click", ".decrement-btn", function () {
    let qtyInput = $(this).siblings(".qty-input");
    let currentQty = parseInt(qtyInput.val());

    if (currentQty > 1) {
        let newQty = currentQty - 1;
        qtyInput.val(newQty);
        updateSubtotal(qtyInput);
    }
});

function updateSubtotal(input) {
    let row = input.closest("tr");
    let price = parseFloat(row.find("td:eq(2)").text().replace("₹", ""));
    let qty = parseInt(input.val());
    let subtotal = price * qty;

    row.find(".subtotal").text("₹" + subtotal.toFixed(2));
    updateTotal();
}




    function updateTotal() {
        let total = 0;
        $("#cart-body tr").each(function () {
            let price = parseFloat($(this).find("td:eq(3)").text().replace("₹", ""));
            let qty = parseInt($(this).find(".qty-input").val());
            let subtotal = price * qty;
            $(this).find(".subtotal").text("₹" + subtotal.toFixed(2));
            total += subtotal;
        });
        $("#total-amount").text("Total: ₹" + total.toFixed(2)); // Update total display
    }

    // $(document).on("input", ".qty-input", function () {
    //     updateTotal(); // Update total when quantity changes
    // });

    $(document).on("click", ".remove-btn", function () {
        $(this).closest("tr").remove();
        togglePayButton(); 
        updateTotal(); // Update total after removing item
    });

    // Add a total row below the cart
    $(".cart-footer").before('<div class="text-end"><h4 id="total-amount">Total: ₹0.00</h4></div>');
});
    $('#openPaymentModal').click(function() {
                // Get total payable amount from cart
                let totalPayable = parseFloat($("#total-amount").text().replace("Total: ₹", "")) || 0;

                let cart = [];

                $("#cart-body tr").each(function () {
                    let productId = $(this).data("product-id");
                    let restaurantId = "<?php echo e(auth()->user()->id); ?>"; 
                    let qty = parseInt($(this).find(".qty-input").val());
                    let amount = parseFloat($(this).find("td:eq(3)").text().replace("₹", ""));

                    cart.push({
                        product_id: productId,
                        restaurant_id: restaurantId,
                        quantity: qty,
                        amount: amount
                    });
                });

                console.log(cart);
                $("#cartData").val(JSON.stringify(cart));
                
                // Update modal fields dynamically
                $("#totalAmount").text(totalPayable.toFixed(2));
                $("#totalPayable").text(totalPayable.toFixed(2));
                $("#balanceAmount").text(totalPayable.toFixed(2));
                $("#totalPaying").text("0.00");
                $("#totalItems").text($("#cart-body tr").length);

                // Show modal
                $("#paymentModal").modal('show');
            });

        // Update paying amount
        $("#amountPaid").on("input", function() {
            let payingAmount = parseFloat($(this).val()) || 0;
            let totalPayable = parseFloat($("#totalPayable").text());

            let balance = totalPayable - payingAmount;
            $("#totalPaying").text(payingAmount.toFixed(2));
            $("#balanceAmount").text(balance.toFixed(2));
        });
        $("#couponError").hide();
        $("#couponCode").on("change", function() {
        let couponCode = $(this).val().trim();
        let totalAmount = parseFloat($("#totalAmount").text()); // Assuming total is displayed somewhere

        $("#couponError").hide(); // Hide previous error message

        if (couponCode !== "") {
            $.ajax({
                url: "<?php echo e(route('coupon.verify')); ?>", // Laravel route
                type: "POST",
                data: { 
                    code: couponCode, 
                    totalAmount: totalAmount, 
                    _token: "<?php echo e(csrf_token()); ?>" 
                },
                success: function(response) {
                    if (response.success) {
                        let discountAmount = response.data[0].discountAmount; // Accessing the discount

                        $("#couponType").text(response.data[0].description);
                        $("#couponValue").text(discountAmount.toFixed(2));
                        $("#discountAmount").text(discountAmount.toFixed(2));

                        // Update payable amount
                        let newTotal = totalAmount - discountAmount;
                        $("#totalPayable").text(newTotal.toFixed(2));
                        $("#balanceAmount").text(newTotal.toFixed(2));
                    } else {
                        $("#couponError").text(response.message).show();
                        $("#couponType").text("N/A");
                        $("#couponValue").text("0.00");
                    }
                },
                error: function() {
                    $("#couponError").text("Error verifying coupon.").show();
                }
            });
        }
    });

    $(document).on("click", "#saveOrder", function () {
        
    let totalPayable = parseFloat($("#totalPayable").text());
    let cartData = $("#cartData").val();
    let restaurantId = "<?php echo e(auth()->user()->id); ?>"; // Get logged-in restaurant ID
    console.log(cartData);
    // Get payment details
    let paymentAccount = $("#paymentAccount").val();
    let orderType = $("#orderTypeSelect").val();
    let tableId = $("#tableNumberSelect").val();
    let paymentNote = $("#paymentNote").val();
    let couponCode = $("#couponCode").val();
    let couponAmount = parseFloat($("#couponValue").text()) || 0;
    let totalDiscount = parseFloat($("#discountAmount").text()) || 0;

    if (cartData.length === 0) {
        alert("Cart is empty! Please add items before saving.");
        return;
    }

    $.ajax({
        url: "<?php echo e(route('orders.place')); ?>", // Laravel route for saving order
        type: "POST",
        data: {
            restaurant_id: restaurantId,
            total_amount: totalPayable,
            payment_account: paymentAccount,
            payment_note: paymentNote,
            coupon_code: couponCode,
            coupon_amount: couponAmount,
            total_discount: totalDiscount,
            order_type:orderType,
            table_id:tableId,
            cart_items: cartData,
            _token: "<?php echo e(csrf_token()); ?>" // CSRF protection
        },
        success: function (response) {
            if (response.success) {
                //$("#paymentModal").modal('hide');
                $("#modalMessage").html(`<div class="alert alert-success">${response.message}</div>`);
                $("#saveOrder").prop("disabled", true);

                $("#total-amount").text("Total: ₹0.00");
                $("#totalPayable").text("0.00");
                $("#balanceAmount").text("0.00");
                $("#totalPaying").text("0.00");
                $("#totalItems").text("0");
                $("#discountAmount").text("0.00");
                $("#couponValue").text("0.00");
                $("#couponType").text("N/A");
                $("#couponCode").val("");

                // $("#successMessage").text(response.message).fadeIn().delay(3000).fadeOut(); 
                $("#cart-body").empty(); // Clear cart after successful order
                $("#totalAmount, #totalPayable, #balanceAmount, #totalPaying").text("0.00"); // Reset totals
            } else {
                let errorMessage = "Error placing order: " + response.message;
                $("#modalMessage").html(`<div class="alert alert-danger">${errorMessage}</div>`);
                // $("#errorMessage").text("Error placing order: " + response.message).fadeIn().delay(3000).fadeOut();
            }
        },
        error: function (xhr) {
            let errorMessage = xhr.responseJSON?.message || "An error occurred. Please try again.";
            $("#modalMessage").html(`<div class="alert alert-danger">${errorMessage}</div>`);
            // $("#errorMessage").text("Something went wrong. Please try again.").fadeIn().delay(3000).fadeOut();
            // console.error(xhr.responseText);
        }
    });
});
// Cancel Button Click - Clear Cart
$(document).on("click", ".btn-danger.btn-pos", function () {
    if (confirm("Are you sure you want to clear the cart?")) {
        $("#cart-body").empty(); 
        $("#total-amount").text("Total: ₹0.00"); 
        togglePayButton(); // Call here
    }
});

function togglePayButton() {
    if ($("#cart-body tr").length > 0) {
        $("#openPaymentModal").prop("disabled", false);
    } else {
        $("#openPaymentModal").prop("disabled", true);
    }
}

let products = [];
    $(".product-card").each(function () {
        products.push({
            label: $(this).data("name"),
            value: $(this).data("product-id"),
            price: $(this).data("price")
        });
    });

    // Initialize jQuery UI Autocomplete
    $("#productSearch").autocomplete({
        source: products,
        select: function (event, ui) {
            // Trigger product selection based on the selected item
            let selectedProduct = $(`.product-card[data-product-id='${ui.item.value}']`);
            if (selectedProduct.length) {
                selectedProduct.click(); // Simulate product card click
            }
            $(this).val(''); // Clear search input after selection
            return false; // Prevent input value from displaying
        }
    });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.restaurant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/restaurant/kot.blade.php ENDPATH**/ ?>