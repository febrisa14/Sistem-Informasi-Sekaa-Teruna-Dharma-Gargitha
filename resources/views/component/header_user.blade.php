<!-- Header -->
<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div class="d-flex align-items-center">
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <!-- END Toggle Sidebar -->

            <!-- Toggle Mini Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                <i class="fa fa-fw fa-ellipsis-v"></i>
            </button>
            <!-- END Toggle Mini Sidebar -->

        </div>
        <!-- END Left Section -->

        <?php
            $nama = Auth::User()->name;
            $email = Auth::User()->email;
            // $split = explode(" ", $nama);
            // $lastname = array_pop($split);
            // $firstname = implode(" ", $split);
            $role = Auth::User()->role;
            $avatar = Auth::User()->avatar;
        ?>

        <!-- Right Section -->
        <div class="d-flex align-items-center">
            <!-- User Dropdown -->
            <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn btn-sm btn-dual d-flex align-items-center" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle" src="{{ asset('/avatar/'.$avatar) }}" alt="Header Avatar" style="width: 21px;">
                    <span class="d-none d-sm-inline-block ml-2">{{ $email }}</span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ml-1 mt-1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 border-0" aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-primary-dark rounded-top">
                        <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset('/avatar/'.$avatar) }}" alt="">
                        <p class="mt-2 mb-0 text-white font-w500">{{ $nama }}</p>
                        <p class="mb-0 text-white-50 font-size-sm">{{ $role }}</p>
                    </div>
                    <div class="p-2">
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{route('user.profile')}}">
                            <span class="font-size-sm font-w500"><i class="fas fa-user mr-1"></i> Profile</span>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('logout') }}"
                        onclick="
                            event.preventDefault();
                            document.getElementById('logout-form').submit();
                        ">
                            <span class="font-size-sm font-w500"><i class="fas fa-power-off mr-1"></i> Log Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <!-- END User Dropdown -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->
</header>
<!-- END Header -->
