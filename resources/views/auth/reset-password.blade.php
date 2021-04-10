@extends('component/auth')

@section('content')
<!-- Reminder Block -->
<div class="block block-rounded block-themed mt-3 mb-0">
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
            <p class="text-muted">Silahkan masukan password baru dan konfirmasi password baru anda.</p>

            <!-- Reminder Form -->
            <!-- jQuery Validation (.js-validation-reminder class is initialized in js/pages/op_auth_reminder.min.js which was auto compiled from _js/pages/op_auth_reminder.js) -->
            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg form-control-alt" id="email" name="email" value="{{ old('email', $request->email) }}" placeholder="Masukan Email" required autofocus />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-lg form-control-alt" id="password" name="password" placeholder="Masukan Password Baru" required/>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-lg form-control-alt" id="password_confirmation" name="password_confirmation" placeholder="Masukan Konfirmasi Password Baru" required/>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-block btn-alt-success">
                            <i class="fa fa-save mr-1"></i> Reset Password
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
