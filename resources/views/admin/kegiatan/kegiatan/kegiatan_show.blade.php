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
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
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
                @if (Auth::user()->pengurus->jabatan->nama_jabatan == 'Ketua STT' || Auth::user()->pengurus->jabatan->nama_jabatan == 'Wakil Ketua STT' || Auth::user()->pengurus->jabatan->nama_jabatan == 'Sekretaris 1' || Auth::user()->pengurus->jabatan->nama_jabatan == 'Sekretaris 2')
                <a href="{{route('admin.kegiatan.cetak', ['id' => $kegiatan->kegiatan_id])}}" id="addKegiatan" class="btn btn-sm btn-alt-primary px-2 py-2">
                    <i class="fa fa-print mr-1"></i> Cetak Kegiatan
                </a>
                @endIf
            </div>
            <div class="block-content block-content-full">
                <div class="block-content font-size-sm">
                    <table class="table table-borderless">
                        <tr>
                            <td width="140px"><b>Nama Kegiatan</b></td>
                            <td width="40px">:</td>
                            <td><span>{{$kegiatan->nama_kegiatan}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Tanggal Kegiatan</b></td>
                            <td>:</td>
                            <td><span>{{$kegiatan->tgl_kegiatan}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Jam Kegiatan</b></td>
                            <td>:</td>
                            <td><span>{{$kegiatan->jam_kegiatan}} WITA</span></td>
                        </tr>
                        <tr>
                            <td><b>Pakaian</b></td>
                            <td>:</td>
                            <td><span>{{$kegiatan->pakaian}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Lokasi Kegiatan</b></td>
                            <td>:</td>
                            <td><span>{{$kegiatan->lokasi}}</span></td>
                        </tr>
                    </table>
                    <table class="table table-borderless">
                        <tr class="bg-primary text-white">
                            <td><b>Pengumuman ini dibuat pada</b></td>
                            <td>:</td>
                            <td><span>{{$kegiatan->created_at}}</span></td>
                            <td><b>Pengumuman ini dibuat oleh</b></td>
                            <td>:</td>
                            <td><span>{{$kegiatan->name}}</span></td>
                        </tr>
                    </table>
                </div>
            </div><!-- End Block Content -->
        </div>
        @endforeach
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop
