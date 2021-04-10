<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header bg-white-5">
        <img class="smini-visible" src="{{ url('assets/media/logo/logo-login.png') }}" alt="" width="10%">
        <!-- Logo -->
        <a class="font-w600 text-dual" href="#">
            <span class="smini-hide font-size-h5 tracking-wider">
                <span class="font-w400">SI</span>STDG
            </span>
        </a>
        <!-- END Logo -->

        <!-- Extra -->
        <div>
            <!-- Close Sidebar, Visible only on mobile screens -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="d-lg-none btn btn-sm btn-dual ml-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>
            <!-- END Close Sidebar -->
        </div>
        <!-- END Extra -->
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                        <i class="nav-main-link-icon si si-home"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-heading">Transaksi</li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fas fa-money-check-alt"></i>
                        <span class="nav-main-link-name">Pemesanan</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="be_comp_loaders.html">
                                <span class="nav-main-link-name">Detail Pesanan</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading">Master Data</li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Request::is('anggota/anggota*') ? 'active' : '' }}" href="{{ route('user.anggota.index') }}">
                        <i class="nav-main-link-icon fa fa-users"></i>
                        <span class="nav-main-link-name">Anggota</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Request::is('anggota/pengurus*') ? 'active' : '' }}" href="{{ route('user.pengurus.index') }}">
                        <i class="nav-main-link-icon fa fa-user-friends"></i>
                        <span class="nav-main-link-name">Pengurus</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Request::is('anggota/pengumuman*') ? 'active' : '' }}" href="{{ route('user.pengumuman.index') }}">
                        <i class="nav-main-link-icon fas fa-list"></i>
                        <span class="nav-main-link-name">Pengumuman</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="#">
                        <i class="nav-main-link-icon fas fa-image"></i>
                        <span class="nav-main-link-name">Galeri</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="#">
                        <i class="nav-main-link-icon fas fa-dollar-sign"></i>
                        <span class="nav-main-link-name">Kas</span>
                    </a>
                </li>
                <li class="nav-main-heading">Akun</li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Request::is('anggota/profile*') ? 'active' : '' }}" href="{{route('user.profile')}}">
                        <i class="nav-main-link-icon fas fa-user"></i>
                        <span class="nav-main-link-name">Profile</span>
                    </a>
                </li>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->
