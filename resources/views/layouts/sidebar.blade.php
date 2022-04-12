<div class="main-sidebar" style="overflow: auto;
/*background-image: linear-gradient(195deg, #2e2e4d, #171745);*/
background-color: #fff !important">
    <aside id="sidebar-wrapper  p-3">
        <div class="sidebar-brand">
            @if(Auth::user()->load('roles')->roles->contains('title', 'vendor'))
                @if(Auth::user()->load('roles')->roles->contains('title', 'vendor'))
                    @php
                        $vendor = App\Models\Vendor::where('user_id',auth()->user()->id)->first();
                    @endphp
                @endif
                <a href="{{ url('vendor/vendor_home')}}">
                    <img src="{{ $vendor->vendor_logo }}" class="rounded" width="150" height="150" alt="">
                </a>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="{{ url('vendor/vendor_home') }}">
                        <img src="{{ $vendor->vendor_logo }}" class="rounded" width="20" height="20" alt="">
                    </a>
                </div>
            @endif

            @php
                $icon = App\Models\GeneralSetting::find(1)->company_black_logo;
            @endphp

            @if(Auth::user()->load('roles')->roles->contains('title', 'admin'))
                {{-- <div class="sidebar-brand"> --}}
                    <a href="{{ url('home')}}">
                        <img src="{{ url('images/o.png')}}" width="80" height="">
                    </a>
                {{-- </div> --}}
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="{{ url('admin/home')}}">
                        <img src="{{ url('images/o.png')}}" width="20" height="">
                    </a>
                </div>
            @endif
        </div>

        <ul class="sidebar-menu">
            <li class="{{ $activePage == 'home' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/home') }}">
                    <i class="fas fa-columns"></i>
                    <span>{{__('Dashboard')}}</span>
                </a>
            </li>
            <li class="{{ $activePage == 'machine' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/machine') }}">
                    <i class="fas fa-hdd"></i>
                    <span>{{__('Machine')}}</span>
                </a>
            </li>
            <li class="{{ $activePage == 'production' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/production') }}">
                    <i class="fas fa-pallet"></i>
                    <span>{{__('Production')}}</span>
                </a>
            </li>
            <li class="{{ $activePage == 'action' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/action') }}">
                    <i class="fas fa-tasks"></i>
                    <span>{{__('Action')}}</span>
                </a>
            </li>
            <li class="{{ $activePage == 'user' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/user') }}">
                    <i class="fas fa-users"></i>
                    <span class="nav-link-text">{{__('User')}}</span>
                </a>
            </li>
            <li class="{{ $activePage == 'setting' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/setting') }}">
                    <i class="fas fa-cog"></i>
                    <span class="nav-link-text">{{__('Settings')}}</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
