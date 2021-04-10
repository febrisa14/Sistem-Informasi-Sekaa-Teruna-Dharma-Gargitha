@extends('component/auth')

@section('content')
<!-- Reminder Block -->
<div class="block block-rounded block-themed mt-4 mb-0">
    <div class="block-header bg-primary-dark">
        <h3 class="block-title">SI STDG</h3>
        <div class="block-options">
            <a class="btn-block-option" href="{{ route('login') }}" data-toggle="tooltip" data-placement="right" title="Log in">
                <i class="fa fa-sign-in-alt"></i>
            </a>
        </div>
    </div>
    <div class="block-content">
        <img src="../assets/media/logo/logo-login.png" alt="" width="20%" class="rounded mx-auto d-block">
        <hr>
        <div class="p-sm-3 px-lg-3 py-lg-2">
            <h3 class="mb-1">Reset Password</h3>
            <p class="text-muted">Silahkan masukan email yang ingin di reset password.</p>

            <!-- Reminder Form -->
            <!-- jQuery Validation (.js-validation-reminder class is initialized in js/pages/op_auth_reminder.min.js which was auto compiled from _js/pages/op_auth_reminder.js) -->
            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-group pt-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-envelope"></i>
                          </div>
                        </div>
                    <input type="text" class="form-control form-control-lg" id="email" name="email" value="{{ old('email') }}" placeholder="Masukan Email" required autofocus />
                    </div>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <i class="bx bx-check"></i>
                        Kami telah mengirim <strong>request password reset</strong> ke email anda, Silahkan check email anda!
                    </div>
                @endif
                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-block btn-alt-primary">
                            <i class="mdi mdi-send mr-1"></i> Send Request
                        </button>
                    </div>
                </div>
            </form>
            <!-- END Reminder Form -->
        </div>
    </div>
</div>
<!-- END Reminder Block -->

@if ($errors->any)
    @foreach ($errors->all() as $message)
    <script>
        iziToast.error({
            title: 'Error',
            message: '{{ $message }}',
            position: 'bottomRight',
        });
    </script>
    @endforeach
@endif

@stop

