<div class="leftside-menu">
    
    <!-- LOGO -->
    <a href="{{route('restaurant.dashboard')}}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('public/backend/assets/images/logo.png') }}" alt="" height="50">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('public/backend/assets/images/logo_sm.png') }}" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <!-- Dashboard -->
            <li class="side-nav-item">
                <a href="{{route('restaurant.dashboard')}}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <!-- Orders -->
            <li class="side-nav-item">
                <a href="#ordersMenu" data-bs-toggle="collapse" class="side-nav-link">
                    <i class="uil-shopping-cart"></i>
                    <span> Orders </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="ordersMenu">
                    <ul class="side-nav-second-level">
                        <li><a href="{{ url('restaurant/orders/kot') }}"><i class="uil-arrow-right"></i> KOT</a></li>
                        <li><a href="{{ url('restaurant/orders') }}"><i class="uil-arrow-right"></i> All Orders</a></li>
                        <li><a href="{{ url('restaurant/purchases/dine_in') }}"><i class="uil-arrow-right"></i> Dine-In Purchases</a></li>
                        <li><a href="{{ url('restaurant/purchases/home_delivery') }}"><i class="uil-arrow-right"></i> Delivery Purchases</a></li>
                    </ul>
                </div>
            </li>

            <!-- Menu Management -->
            <li class="side-nav-item">
                <a href="#menuManagement" data-bs-toggle="collapse" class="side-nav-link">
                    <i class="uil-list-ul"></i>
                    <span> Menu Management </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="menuManagement">
                    <ul class="side-nav-second-level">
                        <li><a href="{{ route('restaurant.tables.index') }}"><i class="uil-arrow-right"></i>Manage Tables</a></li>
                        <li><a href="{{route('restaurant.categories.index')}}"><i class="uil-arrow-right"></i> Manage Category</a></li>
                        <li><a href="{{route('restaurant.products.index')}}"><i class="uil-arrow-right"></i> Manage Products</a></li>
                        <li><a href="{{route('restaurant.stocks.index')}}"><i class="uil-arrow-right"></i> Manage Stocks</a></li>
                        <li><a href="{{route('restaurant.stocks.todays_stock')}}"><i class="uil-arrow-right"></i>Todays Stocks</a></li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('restaurant.employees.index') }}" class="side-nav-link">
                    <i class="uil-user"></i>
                    <span>  Manage Employee </span>
                </a>
            </li>
            <!-- Profile -->
            <li class="side-nav-item">
                <a href="{{url('restaurant/myprofile')}}" class="side-nav-link">
                    <i class="uil-user"></i>
                    <span> My Profile </span>
                </a>
            </li>

            <!-- Settings -->
            {{-- <li class="side-nav-item">
                <a href="{{url('restaurant/settings')}}" class="side-nav-link">
                    <i class="uil-cog"></i>
                    <span> Settings </span>
                </a>
            </li> --}}

            <!-- Logout -->
            <li class="side-nav-item">
                <a href="{{route('restaurant.logout')}}" class="side-nav-link">
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
