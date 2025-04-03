<div class="leftside-menu">
    
    <!-- LOGO -->
    <a href="<?php echo e(route('employee.dashboard')); ?>" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="<?php echo e(asset('public/backend/assets/images/logo.png')); ?>" alt="" height="50">
        </span>
        <span class="logo-sm">
            <img src="<?php echo e(asset('public/backend/assets/images/logo_sm.png')); ?>" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!-- Fetch Employee Permissions -->

        <?php
        $employee = auth()->guard('employee')->user();
        $permissions = DB::table('roles_permissions')
            ->join('permissions', 'roles_permissions.permission_id', '=', 'permissions.id')
            ->whereIn('roles_permissions.role_id', function ($query) use ($employee) {
                $query->select('role_id')
                    ->from('employee_roles')
                    ->where('employee_id', $employee->id);
            })
            ->pluck('permissions.slug') // Plucking 'slug' instead of 'name'
            ->toArray();
       
        ?>


        <!-- Sidebar Menu -->
        <ul class="side-nav">
            <li class="side-nav-title side-nav-item">Navigation</li>

            <!-- Dashboard -->
            <?php if(in_array('view_dashboard', $permissions)): ?>
                <li class="side-nav-item">
                    <a href="<?php echo e(route('employee.dashboard')); ?>" class="side-nav-link">
                        <i class="uil-home-alt"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Orders -->
            <?php if(in_array('manage_orders', $permissions)): ?>
                <li class="side-nav-item">
                    <a href="#ordersMenu" data-bs-toggle="collapse" class="side-nav-link">
                        <i class="uil-shopping-cart"></i>
                        <span> Orders </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="ordersMenu">
                        <ul class="side-nav-second-level">
                            <li><a href="<?php echo e(url('employee/orders/kot')); ?>"><i class="uil-arrow-right"></i> KOT</a></li>
                            <li><a href="<?php echo e(url('employee/orders')); ?>"><i class="uil-arrow-right"></i> All Orders</a></li>
                            <li><a href="<?php echo e(url('employee/purchases/dine_in')); ?>"><i class="uil-arrow-right"></i> Dine-In Purchases</a></li>
                            <li><a href="<?php echo e(url('employee/purchases/home_delivery')); ?>"><i class="uil-arrow-right"></i> Delivery Purchases</a></li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>

            <!-- Menu Management -->
            <?php if(in_array('manage_menu', $permissions)): ?>
                <li class="side-nav-item">
                    <a href="#menuManagement" data-bs-toggle="collapse" class="side-nav-link">
                        <i class="uil-list-ul"></i>
                        <span> Menu Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menuManagement">
                        <ul class="side-nav-second-level">
                            <?php if(in_array('manage_tables', $permissions)): ?>
                                <li><a href="<?php echo e(route('employee.tables.index')); ?>"><i class="uil-arrow-right"></i> Manage Tables</a></li>
                            <?php endif; ?>
                            <?php if(in_array('manage_categories', $permissions)): ?>
                                <li><a href="<?php echo e(route('employee.categories.index')); ?>"><i class="uil-arrow-right"></i> Manage Category</a></li>
                            <?php endif; ?>
                            <?php if(in_array('manage_products', $permissions)): ?>
                                <li><a href="<?php echo e(route('employee.products.index')); ?>"><i class="uil-arrow-right"></i> Manage Products</a></li>
                            <?php endif; ?>
                            <?php if(in_array('manage_stocks', $permissions)): ?>
                                <li><a href="<?php echo e(route('employee.stocks.index')); ?>"><i class="uil-arrow-right"></i> Manage Stocks</a></li>
                                <li><a href="<?php echo e(route('employee.stocks.todays_stock')); ?>"><i class="uil-arrow-right"></i> Today's Stocks</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>

            <!-- Employee Management -->
            

            <!-- Profile -->
            <li class="side-nav-item">
                <a href="<?php echo e(url('employee/myprofile')); ?>" class="side-nav-link">
                    <i class="uil-user"></i>
                    <span> My Profile </span>
                </a>
            </li>

            <!-- Logout -->
            <li class="side-nav-item">
                <a href="<?php echo e(route('employee.logout')); ?>" class="side-nav-link">
                    <i class="uil-sign-out-alt"></i>
                    <span> Logout </span>
                </a>
            </li>

        </ul>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/employee/include/sidebar.blade.php ENDPATH**/ ?>