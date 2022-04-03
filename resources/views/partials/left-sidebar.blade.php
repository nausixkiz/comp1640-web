<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="{{ route('home') }}" class="waves-effect">
                        <i class="mdi mdi-home-variant-outline"></i>
                        <span>{{ __('Home') }}</span>
                    </a>
                </li>

                <li class="menu-title">{{ __('Management') }}</li>

                <li>
                    <a href="{{ route('users.index') }}" class="waves-effect">
                        <i class="mdi mdi-account"></i>
                        <span>{{ __('User List') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('posts.index') }}" class="waves-effect">
                        <i class="mdi mdi-account"></i>
                        <span>{{ __('Post List') }}</span>
                    </a>
                </li>


                <li class="menu-title">{{ __('Management') }}</li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
