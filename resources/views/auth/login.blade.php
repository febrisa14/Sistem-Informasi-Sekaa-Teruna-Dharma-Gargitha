@extends('component/auth')

@section('content')
<!-- Sign In Block -->
<div class="block block-rounded block-themed mt-3 mb-0">
    <div class="block-header bg-primary-dark">
        <h3 class="block-title">SI STDG</h3>
        <div class="block-options">
            {{-- <a class="btn-block-option font-size-md" href="{{ route('password.request') }}">Lupa Password?</a> --}}
            <a class="btn-block-option" href="{{ route('register') }}" data-toggle="tooltip" data-placement="right" title="Register Anggota">
                <i class="fa fa-user-plus"></i>
            </a>
        </div>
    </div>
    <div class="block-content">
        <img src="assets/media/logo/logo-login.png" alt="" width="20%" class="rounded mx-auto d-block">
        <hr>
        <div class="p-sm-3 px-lg-3 py-lg-2">
            <h3 class="mb-1">Login</h3>
            <p class="text-muted">Silahkan isi form berikut untuk login.</p>
            <!-- Sign In Form -->
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <p class="mb-0"><i class="bx bx-check mr-1"></i><strong>{{session('status')}}</strong></p>
                        </div>
                    @endif
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                              </div>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email.." value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                              </div>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password..">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="mt-2 col-md-12">
                        <button type="submit" data-toggle="click-ripple" class="btn btn-block btn-success">
                            <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Log in
                        </button>
                    </div>
                </div>
            </form>
            <!-- END Sign In Form -->
        </div>
    </div>
</div>
<!-- END Sign In Block -->

@if ($message = Session::get('success'))
<script>
    iziToast.success({
        title: 'Success',
        message: '{{$message}}',
        position: 'topRight'
    });
</script>
@endif

{{-- @if ($message = Session::get('failed'))
<script>
iziToast.warning({
    title: 'Login Gagal',
    message: '{{$message}}',
    position: 'bottomRight'
});
</script>
@endif --}}

<!-- iziToast Error Tampil -->
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

<script>
    setTimeout(function(){
        $('.alert-success').alert('close');
    }, 3000);
</script>
@endsection

