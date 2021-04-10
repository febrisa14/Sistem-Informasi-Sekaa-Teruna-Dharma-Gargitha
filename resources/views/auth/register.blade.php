@extends('component/auth')

@section('content')
<!-- Sign Up Block -->
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
        <img src="assets/media/logo/logo-login.png" alt="Logo STDG" width="20%" class="rounded mx-auto d-block">
        <hr>
        <div class="p-sm-3 px-lg-3 py-lg-4">
            <h3 class="mb-1">Register Anggota</h3>
            <p class="text-muted">Silahkan isi form berikut untuk mendaftar.</p>
            <!-- Sign Up Form -->
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div>
                    @if ($errors->any)
                        @foreach ($errors->all() as $message)
                        <script>
                            iziToast.error({
                                title: 'ERROR',
                                message: '{{ $message }}',
                                position: 'bottomRight',
                            });
                        </script>
                        @endforeach
                    @endif
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                              </div>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email.." value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                              </div>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password..">
                        </div>
                        <small class="form-text text-danger"><strong>* Password Minimal 8 Karakter</strong></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name') }}" placeholder="Masukan Nama Lengkap...">
                    </div>
                    <div class="form-group mb-3">
                        <label for="tgl_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="text" class="js-flatpickr form-control bg-white @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" name="tgl_lahir" placeholder="d-m-Y" data-date-format="d-m-Y">
                    </div>
                    <div class="form-group mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="custom-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="">- Pilih -</option>
                            <option value="Laki - Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="2" placeholder="Masukan Alamat Lengkap...">{{ old('alamat') }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="no_telp">No. Telp <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" placeholder="Masukan No. Telp..." value="{{ old('no_telp') }}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="tempekan">Nama Tempekan <span class="text-danger">*</span></label>
                        <select class="custom-select @error('tempekan') is-invalid @enderror" id="tempekan" name="tempekan">
                            <option value="">- Pilih -</option>
                            <option value="Kauh">Kauh</option>
                            <option value="Kangin">Kangin</option>
                            <option value="Kubu">Kubu</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="mt-2 col-md-12">
                        <button type="submit" data-toggle="click-ripple" class="btn btn-block btn-success"><i class="fa fa-chevron-right mr-1"></i> Register                      </button>
                    </div>
                </div>
            </form>
            <!-- END Sign Up Form -->
        </div>
    </div>
</div>

<script>
    setTimeout(function()
        {
            $('.is-invalid').removeClass('is-invalid');
        }, 2000
    );
</script>
<!-- END Sign Up Block -->
@endsection
