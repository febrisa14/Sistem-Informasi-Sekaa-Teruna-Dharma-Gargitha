@extends('component/app')

@section('content')
<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Ubah Data Anggota
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.anggota.index') }}">Anggota</a></li>
                        <li class="breadcrumb-item" aria-current="page">Ubah Anggota</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- jQuery Validation (.js-validation class is initialized in js/pages/be_forms_validation.min.js which was auto compiled from _js/pages/be_forms_validation.js) -->
        <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <div class="block block-rounded">
                <div class="block-content block-content-full">
                    <!-- Regular -->
                    <h2 class="content-heading border-bottom mb-4 pb-2">Informasi Akun</h2>
                    <form action="{{ route('admin.anggota.update',$user->user_id) }}" method="POST">
                        @method('PUT')
                        @csrf
                    <div class="row items-push">
                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Masukan Email..">
                                {{-- <small class="form-text text-muted">Contoh: contoh@gmail.com</small> --}}
                            </div>
                            {{-- <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password..">
                            </div> --}}
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Masukan Nama Lengkap...">
                            </div>
                            <div class="form-group">
                                <label for="no_telp">No. Telp</label>
                                <input type="text" class="form-control" value="{{ $user->no_telp }}" id="no_telp" name="no_telp" placeholder="Masukan No. Telp ...">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Masukan Alamat Lengkap...">{{ $user->alamat }}</textarea>
                            </div>
                            {{-- <div class="form-group">
                                <label for="Status">Status</label>
                                <select class="custom-select" id="status" name="status">
                                    <option {{ $user->status == "Aktif" ? 'selected' : ''}} value="Aktif">Aktif</option>
                                    <option {{ $user->status == "Tidak Aktif" ? 'selected' : ''}} value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                            </div> --}}
                        </div>
                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="text" class="js-flatpickr form-control bg-white" id="tgl_lahir" name="tgl_lahir" placeholder="Y-m-d" data-date-format="Y-m-d" value="{{ $user->tgl_lahir }}">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin">
                                    <option {{ $user->jenis_kelamin == "Laki - Laki" ? 'selected' : ''}} value="Laki - Laki">Laki - Laki</option>
                                    <option {{ $user->jenis_kelamin == "Perempuan" ? 'selected' : ''}} value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tempekan">Tempekan</label>
                                <select class="custom-select" id="tempekan" name="tempekan">
                                    <option {{ $user->tempekan == "Null" ? 'selected' : ''}} value="0">- Pilih -</option>
                                    <option {{ $user->tempekan == "Kauh" ? 'selected' : ''}} value="Kauh">Kauh</option>
                                    <option {{ $user->tempekan == "Kubu" ? 'selected' : ''}} value="Kubu">Kubu</option>
                                    <option {{ $user->tempekan == "Kangin" ? 'selected' : ''}} value="Kangin">Kangin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- END Regular -->
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-8 offset-lg-5">
                            <button type="submit" data-toggle="click-ripple" class="btn btn-primary">
                                <i class="fa fa-save mr-1"></i> Update
                            </button>
                        </div>
                    </div>
                    <!-- END Submit -->
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop

@push('scripts')

<!-- Script Error SweetAlert2 -->
@if (Session::has('error'))
<script>
    Swal.fire('Error', '{{ Session::get('error') }}' ,'error');
</script>
@endif

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

@endpush
