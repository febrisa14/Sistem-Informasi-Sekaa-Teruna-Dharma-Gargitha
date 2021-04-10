<!doctype html>
<html lang="en">

<head>

        <meta charset="utf-8" />
        <title>Email Verification | Sistem Informasi ST. Dharma Gargitha</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('assets/media/favicons/favicon.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ url('assets/media/favicons/favicon.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ url('assets/media/favicons/favicon.png') }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('auth/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('auth/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('auth/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <div class="account-pages my-4 pt-sm-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5 text-muted">
                            <a href="index.html" class="d-block auth-logo">
                                {{-- <img src="../assets/media/logo/logo-login.png" alt="" height="50" class="auth-logo-dark mx-auto"> --}}
                            </a>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row justify-content-center mt-3">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body">

                                <div class="p-2">
                                    <div class="text-center">

                                        <div class="avatar-md mx-auto">
                                            <div class="avatar-title rounded-circle bg-light">
                                                <i class="bx bxs-envelope h1 mb-0 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="p-2 mt-4">
                                            <h4>Verifikasi Email Anda</h4>
                                            <p class="mt-4">Email kamu belum diverifikasi, Silahkan klik <strong>"Submit Request"</strong> untuk mendapatkan link verifikasi.</p>
                                            @if (session('status') == 'verification-link-sent')
                                                <div class="alert alert-success" role="alert">
                                                    <i class="bx bx-check"></i>
                                                    Kami telah mengirim email verifikasi ke <span class="font-weight-semibold">{{Auth::user()->email}}</span>, Silahkan check email kamu!
                                                </div>
                                            @endif
                                            <div class="mt-4">
                                                <form id="resend-verification" method="POST" action="{{ route('verification.send') }}">
                                                    @csrf
                                                    <a href="{{ route('verification.send') }}" onclick="
                                                    event.preventDefault();
                                                    document.getElementById('resend-verification').submit();"
                                                    class="btn btn-success w-md">Send Request</a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="mt-2 text-center">
                            <p> Sistem Informasi ST. Dharma Gargitha © <script>document.write(new Date().getFullYear())</script></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="../auth/libs/jquery/jquery.min.js"></script>
        <script src="../auth/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../auth/libs/metismenu/metisMenu.min.js"></script>
        <script src="../auth/libs/simplebar/simplebar.min.js"></script>
        <script src="../auth/libs/node-waves/waves.min.js"></script>

        <!-- App js -->
        <script src="../auth/js/app.js"></script>
    </body>

</html>

