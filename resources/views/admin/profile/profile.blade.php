@extends('component/app')

@section('content')
<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-image" style="background-image: url('../assets/media/photos/photo21@2x.jpg');">
        <div class="bg-black-50">
            <div class="content content-full text-center">
                <div class="my-3">
                    <img class="img-avatar img-avatar-thumb" src="{{ asset('/avatar/'.$users->avatar) }}" alt="">
                </div>
                <h1 class="h2 text-white mb-0">{{ $users->name }}</h1>
                <h2 class="h4 font-w400 text-white-75">
                    {{ $users->nama_jabatan }}
                </h2>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content content-boxed">
        <!-- User Profile -->
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Foto Profile</h3>
            </div>
            <div class="block-content">
                <form action="{{route('admin.change_foto')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="font-size-sm text-muted">
                                Anda dapat mengganti foto profile bawaan sesuka hati dengan foto profile milikmu.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="form-group">
                                <label>Foto Profile</label>
                                <div class="push">
                                    <img class="img-avatar" src="{{ asset('/avatar/'.$users->avatar) }}" alt="">
                                </div>
                                <div class="custom-file">
                                    <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                    <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="avatar" name="avatar">
                                    <label class="custom-file-label" for="one-profile-edit-avatar">Ubah foto profile</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" data-toggle="click-ripple" class="btn btn-alt-primary">
                                    <i class="fa fa-save mr-1"></i> Update
                                </button>
                                <a href="{{route('admin.delete_foto')}}" data-toggle="click-ripple" class="btn btn-alt-danger">
                                    <i class="fa fa-trash mr-1"></i> Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END User Profile -->

        <!-- Billing Information -->
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Informasi Akun</h3>
            </div>
            <div class="block-content">
                <form action="{{ route('admin.change_profile')}}" method="POST">
                    @csrf
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="font-size-sm text-muted">
                                Anda dapat mengupdate informasi akun apabila terdapat kekeliruan dalam pengisian data.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $users->name }}">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="2">{{ $users->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $users->email }}">
                                {{-- @if ($users->email_verified_at == '')
                                    <small class="form-text text-danger"><i class="far fa-window-close mr-1"></i>Email Belum Diverifikasi</small>
                                @else
                                <small class="form-text text-success"><i class="fa fa-check mr-1"></i>Email Sudah Terverifikasi</small>
                                @endif --}}
                            </div>
                            <div class="form-group">
                                <label for="no_telp">No. Telp</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $users->no_telp }}">
                            </div>
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="text" class="js-flatpickr form-control bg-white" id="tgl_lahir" name="tgl_lahir" placeholder="d-m-Y" data-date-format="d-m-Y" value="{{ $users->tgl_lahir }}">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin">
                                    <option {{ $users->jenis_kelamin == "Laki - Laki" ? 'selected' : ''}} value="Laki - Laki">Laki - Laki</option>
                                    <option {{ $users->jenis_kelamin == "Perempuan" ? 'selected' : ''}} value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" data-toggle="click-ripple" class="btn btn-alt-primary">
                                    <i class="fa fa-save mr-1"></i> Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Billing Information -->

        <!-- Change Password -->
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Ganti Password</h3>
            </div>
            <div class="block-content">
                <form action="{{ route('admin.change_password') }}" method="POST">
                    @csrf
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="font-size-sm text-muted">
                                Pastikan selalu menggunakan password dengan kombinasi yang rumit dan rahasia agar akun lebih aman.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="form-group">
                                <label>Password Lama</label>
                                <input type="password" class="form-control" id="password_lama" name="password_lama" @error ('password_lama') autofocus @enderror>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Password Baru</label>
                                    <input type="password" class="form-control" id="password_baru" name="password_baru">
                                    <small class="form-text text-muted">Password Minimal 8 Karakter</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="one-profile-edit-password-new-confirm">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" id="konfirmasi_password_baru" name="konfirmasi_password_baru">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" data-toggle="click-ripple" class="btn btn-alt-primary">
                                    <i class="fa fa-save mr-1"></i> Update Password
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Change Password -->

    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop

@push('scripts')

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

    <!-- Script Success SweetAlert2 -->
    @if (Session::has('success'))
    <script>
        Swal.fire('Success', '{{ Session::get('success') }}' ,'success');
    </script>
    @endif

    <!-- Script Error SweetAlert2 -->
    @if (Session::has('error'))
    <script>
        Swal.fire('Error', '{{ Session::get('error') }}' ,'error');
    </script>
    @endif

@endpush
