<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{ url('assets/media/favicons/favicon.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ url('assets/media/favicons/favicon.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ url('assets/media/favicons/favicon.png') }}">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <link rel="stylesheet" href="{{ asset('auth/css/icons.min.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">

        <!-- DatePicker CSS -->
        <link rel="stylesheet" href="{{ url('assets/js/plugins/flatpickr/flatpickr.min.css') }}">

        <!-- SweetAlert CSS -->
        <link rel="stylesheet" href="{{ url('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">

        <!-- Datatables CSS -->
        <link rel="stylesheet" href="{{ url('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ url('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

        <!-- IziToast -->
        <link rel="stylesheet" href="{{ url('assets/js/plugins/iziToast/iziToast.min.css') }}">

        <!-- Fonts and OneUI framework -->
        <link rel="stylesheet" href="{{ url('assets/fonts/Inter/font-face.css') }}">

        <link rel="stylesheet" id="css-main" href="{{ url('assets/css/oneui.min.css') }}">

        <!-- END Stylesheets -->
    </head>
    <body>
        <!-- Page Container -->
        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">

            <!-- Manggil Sidebar Admin -->
            @includeWhen(Auth::User()->role == 'Pengurus', '/component/sidebar_admin')

            <!-- Manggil Sidebar User -->
            @includeWhen(Auth::User()->role == 'Anggota', '/component/sidebar_user')

            <!-- Manggil Header Admin -->
            @includeWhen(Auth::User()->role == 'Pengurus', '/component/header_admin')

            <!-- Manggil Header User -->
            @includeWhen(Auth::User()->role == 'Anggota', '/component/header_user')

            @yield('content')

            <!-- Footer -->
            <footer id="page-footer" class="bg-body-light">
                <div class="content py-3">
                    <div class="row font-size-sm">
                        <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-left">
                            <a class="font-w600" href="#">Sistem Informasi ST. Dharma Gargitha</a> &copy; <span data-toggle="year-copy"></span>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->

        </div>
        <!-- END Page Container -->

        <script src="{{ url('assets/js/oneui.core.min.js') }}"></script>
        <script src="{{ url('assets/js/oneui.app.min.js') }}"></script>

        <script src="{{ url('assets/js/plugins/iziToast/iziToast.min.js') }}"></script>

        <!-- SweetAlert JS Plugins -->
        <script src="{{ url('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

        <!-- Datatables Plugins -->
        <script src="{{ url('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

        <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

        <!-- Flatpickr JS Plugins -->
        <script src="{{ url('assets/js/plugins/flatpickr/flatpickr.js') }}"></script>

        <!-- Page JS Helpers (jQuery Sparkline Plugins) -->
        <script>
            jQuery(function () {
                One.helpers(['flatpickr','magnific-popup']);
            });
        </script>

        @stack('scripts')

    </body>
</html>
