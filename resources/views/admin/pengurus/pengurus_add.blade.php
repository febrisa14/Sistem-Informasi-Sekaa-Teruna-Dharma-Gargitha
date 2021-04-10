@extends('component/app')

@section('content')
<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Add Data Pengurus
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.pengurus.index') }}">Pengurus</a></li>
                        <li class="breadcrumb-item" aria-current="page">Add Pengurus</li>
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
                    <form action="{{ route('admin.pengurus.store') }}" method="POST">
                    @csrf
                    <div class="row items-push">
                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email..">
                                {{-- <small class="form-text text-muted">Contoh: contoh@gmail.com</small> --}}
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password..">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Lengkap...">
                            </div>
                            <div class="form-group">
                                <label for="no_telp">No. Telp</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukan No. Telp ...">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="text" class="js-flatpickr form-control bg-white" id="tgl_lahir" name="tgl_lahir" placeholder="d-m-Y" data-date-format="d-m-Y">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="">- Pilih -</option>
                                    <option value="Laki - Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tempekan">Jabatan</label>
                                <select class="custom-select" id="pengurus_jabatan_id" name="pengurus_jabatan_id">
                                    <option value="">- Pilih -</option>
                                    @forelse ($jabatan as $jabatan)
                                        <option value="{{ $jabatan->jabatan_id }}">{{ $jabatan->nama_jabatan }}</option>
                                    @empty
                                        <option value="">-- Tidak Ada Jabatan --</option>
                                    @endforelse
                                    {{-- <option value="Ketua STT">Ketua STT</option>
                                    <option value="Wakil Ketua STT">Wakil Ketua STT</option>
                                    <option value="Sekretaris 1">Sekretaris 1</option>
                                    <option value="Sekretaris 2">Sekretaris 2</option>
                                    <option value="Bendahara 1">Bendahara 1</option>
                                    <option value="Bendahara 2">Bendahara 2</option> --}}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Masukan Alamat Lengkap..."></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- END Regular -->
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-8 offset-lg-5">
                            <button type="submit" data-toggle="click-ripple" class="btn btn-primary">
                                <i class="fa fa-save mr-1"></i> Simpan
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
