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

        <!-- DatePicker CSS -->
        <link rel="stylesheet" href="{{ url('assets/js/plugins/flatpickr/flatpickr.min.css') }}">

        <!-- SweetAlert CSS -->
        <link rel="stylesheet" href="{{ url('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">

        <!-- Datatables CSS -->
        <link rel="stylesheet" href="{{ url('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ url('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

        <!-- IziToast -->
        <link rel="stylesheet" href="{{ url('assets/js/plugins/iziToast/iziToast.min.css') }}">
        <script src="{{ url('assets/js/plugins/iziToast/iziToast.min.js') }}"></script>

        <!-- Fonts and OneUI framework -->
        <link rel="stylesheet" href="{{ url('assets/fonts/Inter/font-face.css') }}">

        <link rel="stylesheet" id="css-main" href="{{ url('assets/css/oneui.min.css') }}">

        <script src="{{ url('assets/js/oneui.core.min.js') }}"></script>
        <script src="{{ url('assets/js/oneui.app.min.js') }}"></script>

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

        <!-- Flatpickr JS Plugins -->
        <script src="{{ url('assets/js/plugins/flatpickr/flatpickr.js') }}"></script>

        <!-- Page JS Helpers (jQuery Sparkline Plugins) -->
        <script>
            jQuery(function () {
                One.helpers(['flatpickr']);
            });
        </script>

        <!-- END Stylesheets -->
    </head>
    <body>
        <!-- Page Container -->
        <!--
            Available classes for #page-container:

        GENERIC

            'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

        SIDEBAR & SIDE OVERLAY

            'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
            'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
            'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
            'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
            'sidebar-dark'                              Dark themed sidebar

            'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
            'side-overlay-o'                            Visible Side Overlay by default

            'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

            'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

        HEADER

            ''                                          Static Header if no class is added
            'page-header-fixed'                         Fixed Header

        HEADER STYLE

            ''                                          Light themed Header
            'page-header-dark'                          Dark themed Header

        MAIN CONTENT LAYOUT

            ''                                          Full width Main Content if no class is added
            'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
            'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
        -->
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

        @stack('scripts')

    </body>
</html>
