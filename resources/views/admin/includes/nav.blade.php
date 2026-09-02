<div class="hk-wrapper" data-layout="vertical" data-layout-style="default" data-menu="dark" data-footer="simple">
    <nav class="hk-navbar navbar navbar-expand-xl navbar-light fixed-top">
        <div class="container-fluid px-5">

            <div class="nav-start-wrap">
                <button class="btn btn-icon btn-rounded btn-flush-dark flush-soft-hover navbar-toggle d-xl-none"><span
                        class="icon"><span class="feather-icon"><i data-feather="align-left"></i></span></span></button>
            </div>
            <!-- /Start Nav -->

            <!-- End Nav -->
            <div class="nav-end-wrap">
                <ul class="navbar-nav flex-row">

                    <li class="nav-item">
                        <div class="dropdown ps-2">
                            <a class=" dropdown-toggle no-caret" href="#" role="button" data-bs-display="static"
                                data-bs-toggle="dropdown" data-dropdown-animation data-bs-auto-close="outside"
                                aria-expanded="false">
                                <div class="avatar avatar-rounded avatar-xs">
                                    <img src="{{asset('admin/images/admin-profile.png')}}" alt="user"
                                        class="avatar-img">
                                </div>
                                <span class="d-none d-xl-inline-block ms-1 text-black"
                                    key="t-henry">{{ Auth::user()->name }}</span>
                                <span class="svg-icon"><i class="ri-arrow-down-s-line d-none d-xl-inline-block" style="color:black"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">

                                <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                                        class="ri-user-line font-size-16 align-middle me-1"></i> <span
                                        key="t-profile">Profile</span></a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('admin.logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i class="ri-logout-box-line font-size-16 align-middle me-1 text-danger"></i>
                                        <span key="t-logout">Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /End Nav -->
        </div>
    </nav>