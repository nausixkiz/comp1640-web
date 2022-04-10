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
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="ri ri-dashboard-fill"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.index') }}" class="waves-effect">
                        <i class="mdi mdi-account"></i>
                        <span>{{ __('User Management') }}</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-note-multiple"></i>
                        <span>Post Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('posts.index') }}">List</a></li>
                        <li><a href="{{ route('posts.create') }}">Create</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('comments.index') }}" class="waves-effect">
                        <i class="ri ri-chat-4-fill"></i>
                        <span>{{ __('Comment Management') }}</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
