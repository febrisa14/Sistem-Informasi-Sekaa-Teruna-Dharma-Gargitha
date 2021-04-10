<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

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

        <link rel="stylesheet" href="{{ asset('auth/css/app.min.css') }}">
        <link rel="stylesheet" href="{{ asset('auth/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('auth/css/icons.min.css') }}">

        <script src="{{ asset('auth/js/app.js') }}"></script>

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
        <div id="page-container">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="hero-static">
                    <div class="content">
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-lg-6 col-xl-4">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                    <div class="content content-full font-size-sm text-muted text-center">
                        <strong>Sistem Informasi Sekaa Teruna Dharma Gargitha</strong> &copy; <span data-toggle="year-copy"></span>
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </body>
</html>
