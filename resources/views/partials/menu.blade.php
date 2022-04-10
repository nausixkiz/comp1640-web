<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <button type="button" class="btn btn-sm px-3 font-size-24 d-lg-none header-item" data-bs-toggle="collapse"
                    data-bs-target="#topnav-menu-content">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="ri-search-line"></span>
                </div>
            </form>

        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                     aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="mb-3 m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="ri-search-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}"
                         alt="{{ \Illuminate\Support\Facades\Auth::user()->name }}">
                    <span class="d-none d-xl-inline-block ms-1">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="ri-shut-down-line align-middle me-1 text-danger"></i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>

<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="mdi mdi-home-variant-outline"></i>
                            <span>{{ __('Home') }}</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0)" id="topnav-apps" role="button">
                            <i class="ri-apps-2-line me-2"></i>{{ __('Management') }} <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <a href="{{ route('dashboard') }}" class="dropdown-item">{{ __('Dashboard') }}</a>
                            <a href="{{ route('users.index') }}" class="dropdown-item">{{ __('User Management') }}</a>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="javascript:void(0)" id="topnav-post-management"
                                   role="button">
                                    {{ __('Post (Idea) Management') }} <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-post-management">
                                    <a href="{{ route('posts.index') }}" class="dropdown-item">{{ __('List All Post (Idea)') }}</a>
                                    <a href="{{ route('posts.create') }}" class="dropdown-item">{{ __('Create New Post (Idea)') }}</a>
                                </div>
                            </div>
                            <a href="{{ route('comments.index') }}" class="dropdown-item">{{ __('Comment Management') }}</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
