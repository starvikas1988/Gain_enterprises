
    <!-- jQuery and jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <span class="account-user-avatar"> 
                    <img src="<?php echo e(asset('public/backend/assets/images/users/avatar-1.jpg')); ?>" alt="user-image" class="rounded-circle">
                </span>
                <span>
                    <span class="account-user-name"><?php echo e(Auth::user()->name); ?></span>
                    <span class="account-position"><?php echo e(Auth::user()->email); ?></span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome <?php echo e(Auth::user()->name); ?>!</h6>
                </div>

                <!-- item-->
                <a href="<?php echo e(route('restaurant.myprofile')); ?>" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle me-1"></i>
                    <span>My Account</span>
                </a>
                <!-- item-->
                <a href="<?php echo e(route('restaurant.changepassword')); ?>" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle me-1"></i>
                    <span>Change Password</span>
                </a>
                <!-- item-->
                <a href="<?php echo e(route('restaurant.logout')); ?>" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout me-1"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>

    </ul>
    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>
   
</div><?php /**PATH C:\xampp\htdocs\gainenterprises\resources\views/restaurant/include/header.blade.php ENDPATH**/ ?>