<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto" action="">
        <ul class="navbar-nav mr-3">
            <li>
                @if(Auth::user()->load('roles')->roles->contains('title', 'admin'))
                    <a href="javascript:void(0);" data-toggle="sidebar" class="nav-link nav-link-lg">
                        <i class="fas fa-bars"></i>
                    </a>
                @endif
            </li>
        </ul>
    </form>
    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <ul class="navbar-nav navbar-right">
            @php
                //$vendor = App\Models\Vendor::where('user_id',auth()->user()->id)->first();
                //$toDay = App\Models\Notification::where([['user_type','vendor'],['user_id',$vendor->id]])->whereBetween('created_at', [Carbon\Carbon::now()->format('Y-m-d')." 00:00:00",  Carbon\Carbon::now()->format('Y-m-d')." 23:59:59"])->get();
                //$notifications = App\Models\Notification::where([['user_type','vendor'],['user_id',$vendor->id]])->get()->take(5);
            @endphp

            {{-- <a href="javascript:void(0);" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg" aria-expanded="false"><i class="far fa-bell"><span class="notification-counter">{{ 0 }}</span></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">{{__('Notifications')}}</div>
                <div class="dropdown-list-content dropdown-list-icons" tabindex="2" style="overflow: hidden; outline: none;">

                </div>
                <div class="dropdown-footer text-center">
                    <a href="{{ url('vendor/notification') }}">{{__('View all')}}<i class="fas fa-chevron-right"></i></a>
                </div>
                <div id="ascrail2001" class="nicescroll-rails nicescroll-rails-vr"
                    style="width: 9px; z-index: 1000; cursor: default; position: absolute; top: 58px; left: 341px; height: 350px; opacity: 0.3; display: block;">
                    <div class="nicescroll-cursors"
                        style="position: relative; top: 0px; float: right; width: 7px; height: 306px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;">
                    </div>
                </div>
                <div id="ascrail2001-hr" class="nicescroll-rails nicescroll-rails-hr"
                    style="height: 9px; z-index: 1000; top: 399px; left: 0px; position: absolute; cursor: default; display: none; width: 341px; opacity: 0.3;">
                    <div class="nicescroll-cursors"
                        style="position: absolute; top: 0px; height: 7px; width: 350px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px; left: 0px;">
                    </div>
                </div>
            </div> --}}


        <li class="dropdown">
            <a href="javascript:void(0);" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="d-sm-none d-lg-inline-block">
                    <img src="images/upload/{{ Auth::user()->image }}" style="border-radius: 30px;" alt="">
                    {{__('BIENVENUE, ')}}
                    {{ Auth::user()->fullname }}

                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">{{__('Bienvenue, ')}}{{ Auth::user()->fullname }}</div>
                @if(Auth::user()->load('roles')->roles->contains('title', 'admin'))
                    <!--can('admin_profile_access')-->
                        <a href="{{ url('admin/admin_profile') }}" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> {{__('Paramètres du compte')}}
                        </a>
                    <!--endcan-->
                @endif

                <div class="dropdown-divider"></div>
                <a href="" class="dropdown-item text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    {{__('Déconnexion')}}
                </a>
            </div>
        </li>
    </ul>
</nav>
