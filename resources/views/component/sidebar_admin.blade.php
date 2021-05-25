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
                    <a class="nav-main-link {{ Request::is('admin') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="nav-main-link-icon si si-home"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-heading">Master Data</li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Request::is('admin/anggota*') ? 'active' : '' }}" href="{{ route('admin.anggota.index') }}">
                        <i class="nav-main-link-icon fa fa-users"></i>
                        <span class="nav-main-link-name">Anggota</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Request::is('admin/pengurus*') ? 'active' : '' }}" href="{{ route('admin.pengurus.index') }}">
                        <i class="nav-main-link-icon fa fa-user-friends"></i>
                        <span class="nav-main-link-name">Pengurus</span>
                    </a>
                </li>
                <li class="nav-main-item {{ Request::is('admin/kegiatan*') || Request::is('admin/jenis_kegiatan*') ? 'open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fas fa-list"></i>
                        <span class="nav-main-link-name">Kegiatan</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Request::is('admin/kegiatan*') ? 'active' : '' }}" href="{{ route('admin.kegiatan.index') }}">
                                <span class="nav-main-link-name">List Kegiatan</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Request::is('admin/jenis_kegiatan*') ? 'active' : '' }}" href="{{ route('admin.jenis_kegiatan.index') }}">
                                <span class="nav-main-link-name">Jenis Kegiatan</span>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-main-item">
                    <a class="nav-main-link" href="#">
                        <i class="nav-main-link-icon fas fa-image"></i>
                        <span class="nav-main-link-name">Galeri</span>
                    </a>
                </li> --}}
                <li class="nav-main-item {{ Request::is('admin/kas*') ? 'open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fas fa-dollar-sign"></i>
                        <span class="nav-main-link-name">Kas</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Request::is('admin/kas/pemasukan*') ? 'active' : '' }}" href="{{ route('admin.pemasukan.index') }}">
                                <span class="nav-main-link-name">Pemasukan</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Request::is('admin/kas/pengeluaran*') ? 'active' : '' }}" href="{{ route('admin.pengeluaran.index') }}">
                                <span class="nav-main-link-name">Pengeluaran</span>
                            </a>
                        </li>
                        @if (Auth::user()->pengurus->jabatan->nama_jabatan == 'Ketua STT' || Auth::user()->pengurus->jabatan->nama_jabatan == 'Wakil Ketua STT' || Auth::user()->pengurus->jabatan->nama_jabatan == 'Bendahara 1' || Auth::user()->pengurus->jabatan->nama_jabatan == 'Bendahara 2')
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Request::is('admin/kas/laporan*') ? 'active' : '' }}" href="{{ route('admin.kas.laporan') }}">
                                <span class="nav-main-link-name">Laporan Kas</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-main-item {{ Request::is('admin/baju*') || Request::is('admin/pemesan*') || Request::is('admin/order*') ? 'open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fas fa-money-check-alt"></i>
                        <span class="nav-main-link-name">Pemesanan</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Request::is('admin/baju*') ? 'active' : '' }}" href="{{ route('admin.baju.index') }}">
                                <span class="nav-main-link-name">Baju</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Request::is('admin/pemesan*') ? 'active' : '' }}" href="{{route('admin.pemesan.index')}}">
                                <span class="nav-main-link-name">Pemesan</span>
                            </a>
                        </li>
                        @if (Auth::user()->pengurus->jabatan->nama_jabatan == 'Ketua STT' || Auth::user()->pengurus->jabatan->nama_jabatan == 'Wakil Ketua STT' || Auth::user()->pengurus->jabatan->nama_jabatan == 'Bendahara 1' || Auth::user()->pengurus->jabatan->nama_jabatan == 'Bendahara 2')
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Request::is('admin/order/laporan*') ? 'active' : '' }}" href="{{ route('admin.pemesanan.laporan') }}">
                                <span class="nav-main-link-name">Laporan Pemesanan</span>
                            </a>
                        </li>
                        @endIf
                    </ul>
                </li>
                <li class="nav-main-heading">Akun</li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Request::is('admin/profile*') ? 'active' : '' }}" href="{{route('admin.profile')}}">
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
