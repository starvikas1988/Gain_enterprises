<div class="leftside-menu">
    
    <!-- LOGO -->
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="<?php echo e(asset('public/backend/assets/images/logo.png')); ?>" alt="" height="50">
        </span>
        <span class="logo-sm">
            <img src="<?php echo e(asset('public/backend/assets/images/logo_sm.png')); ?>" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index-2.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="<?php echo e(asset('public/backend/assets/images/logo.png')); ?>" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="<?php echo e(asset('public/backend/assets/images/logo_sm_dark.png')); ?>" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item <?php echo e(in_array(Request::segment(2),array('dashboard'))?'active':''); ?>">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="side-nav-link <?php echo e(in_array(Request::segment(2),array('dashboard'))?'active':''); ?>">
                    <i class="uil-home-alt"></i>
                    <span> Dashboards </span>
                </a>
            </li>
            
            <?php
            $mainmenu = App\Models\Mainpermission::OrderBy('position','asc')->get();
            $admin = App\Models\Adminrole::Where('admin_id','=',Auth::id())->get();
            ?>
            
            <?php if($mainmenu->isNotEmpty()): ?>
                <?php $__currentLoopData = $mainmenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$menuhead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebar<?php echo e($key); ?>" aria-expanded="false" aria-controls="sidebar<?php echo e($key); ?>" class="side-nav-link">
                            <i class="<?php echo e($menuhead->icon); ?>"></i>
                            <span> <?php echo e($menuhead->name); ?> </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebar<?php echo e($key); ?>">
                            <ul class="side-nav-second-level">
                                
                                <?php
                                $menu = App\Models\Permission::join('roles_permissions','roles_permissions.permission_id','=','permissions.id')->Where('permissions.main_id','=',$menuhead->id)->Where('roles_permissions.role_id','=',$admin[0]->role_id)->Where('permissions.menutype','=','M')->get(['name','slug']);
                                ?>
                                <?php if($menu->isNotEmpty()): ?>
                                    <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$menulist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e(url('admin/'.$menulist->slug)); ?>"><i class="uil-arrow-right"></i> <?php echo e($menulist->name); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                              
                            </ul>
                        </div>
                    </li>
                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            
			
        </ul>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div><?php /**PATH C:\xampp\htdocs\logisticsApp\resources\views/admin/include/sidebar.blade.php ENDPATH**/ ?>