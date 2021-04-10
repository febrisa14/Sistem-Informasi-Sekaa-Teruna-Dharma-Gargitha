@extends('component/app')

@section('content')
<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Detail Kegiatan
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.kegiatan.index') }}">Kegiatan</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail Kegiatan</li>
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
        @foreach ($kegiatans as $kegiatan)
        <div class="block block-rounded">
                <div class="block-header border-bottom">
                    <h3 class="block-title"><small>Informasi Data</small> Kegiatan</h3>
                    <a href="{{route('admin.kegiatan.cetak', ['id' => $kegiatan->kegiatan_id])}}" id="addKegiatan" class="btn btn-sm btn-alt-primary px-2 py-2">
                        <i class="fa fa-print mr-1"></i> Cetak Kegiatan
                    </a>
                </div>
                <div class="block-content block-content-full">
                    <!-- Regular -->
                    @csrf

                    <div class="row items-push">
                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Nama Kegiatan</label>
                                <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" disabled>
                                {{-- <small class="form-text text-muted">Contoh: contoh@gmail.com</small> --}}
                            </div>
                            <div class="form-group">
                                <label>Jenis Kegiatan</label>
                                <select class="custom-select form-control" id="jenis_kegiatan_id" name="jenis_kegiatan_id" disabled>
                                    <option value="{{ $kegiatan->jenis_kegiatan_id }}">{{ $kegiatan->nama_jenis_kegiatan }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Kegiatan</label>
                                <input type="text" class="js-flatpickr form-control" id="tgl_kegiatan" value="{{ $kegiatan->tgl_kegiatan }}" name="tgl_kegiatan" data-date-format="d M Y" disabled>
                            </div>
                            <div class="form-group">
                                <label>Jam Kegiatan</label>
                                <input type="text" class="js-flatpickr form-control" name="jam_kegiatan" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" data-time_24hr="true" value="{{ $kegiatan->jam_kegiatan}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Lokasi Kegiatan</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $kegiatan->lokasi }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Pakaian</label>
                                <input type="text" class="form-control" name="pakaian" value="{{ $kegiatan->pakaian }}" disabled>
                                {{-- <small class="form-text text-muted">Contoh: contoh@gmail.com</small> --}}
                            </div>
                            <div class="form-group">
                                <label>Dibuat Oleh :</label>
                                <input type="text" class="form-control" name="name" value="{{ $kegiatan->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Tanggal Dibuat</label>
                                <input type="text" class="form-control" value="{{ $kegiatan->created_at }}" name="created_at" data-date-format="d M Y" disabled>
                            </div>
                        </div>
                    </div>
                    <!-- END Regular -->
            </div>
        </div>
        @endforeach
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop
