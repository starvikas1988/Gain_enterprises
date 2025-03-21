<div class="leftside-menu">
    
    <!-- LOGO -->
    <a href="{{route('admin.dashboard')}}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('public/backend/assets/images/logo.png') }}" alt="" height="50">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('public/backend/assets/images/logo_sm.png') }}" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index-2.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('public/backend/assets/images/logo.png') }}" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('public/backend/assets/images/logo_sm_dark.png') }}" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item {{in_array(Request::segment(2),array('dashboard'))?'active':''}}">
                <a href="{{route('admin.dashboard')}}" class="side-nav-link {{in_array(Request::segment(2),array('dashboard'))?'active':''}}">
                    <i class="uil-home-alt"></i>
                    <span> Dashboards </span>
                </a>
            </li>
            
            @php
            $mainmenu = App\Models\Mainpermission::OrderBy('position','asc')->get();
            $admin = App\Models\Adminrole::Where('admin_id','=',Auth::id())->get();
            @endphp
            
            @if($mainmenu->isNotEmpty())
                @foreach($mainmenu as $key=>$menuhead)
                
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebar{{$key}}" aria-expanded="false" aria-controls="sidebar{{$key}}" class="side-nav-link">
                            <i class="{{$menuhead->icon}}"></i>
                            <span> {{$menuhead->name}} </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebar{{$key}}">
                            <ul class="side-nav-second-level">
                                
                                @php
                                $menu = App\Models\Permission::join('roles_permissions','roles_permissions.permission_id','=','permissions.id')->Where('permissions.main_id','=',$menuhead->id)->Where('roles_permissions.role_id','=',$admin[0]->role_id)->Where('permissions.menutype','=','M')->get(['name','slug']);
                                @endphp
                                @if($menu->isNotEmpty())
                                    @foreach($menu as $key=>$menulist)
                                    <li><a href="{{url('admin/'.$menulist->slug)}}"><i class="uil-arrow-right"></i> {{$menulist->name}}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </li>
                
                @endforeach
            @endif
            
			
        </ul>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>