@extends('component/app')

@section('content')
<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Ubah Data Kegiatan
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.kegiatan.index') }}">Kegiatan</a></li>
                        <li class="breadcrumb-item" aria-current="page">Ubah Kegiatan</li>
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
                    <h2 class="content-heading border-bottom mb-4 pb-2">Informasi Kegiatan</h2>
                    <form action="{{ route('admin.kegiatan.update',$kegiatan->kegiatan_id) }}" method="POST">
                        @method('PUT')
                        @csrf
                    <div class="row items-push">
                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="nama">Nama Kegiatan</label>
                                <input type="text" class="form-control" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" placeholder="Masukan Nama Lengkap...">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Kegiatan</label>
                                <input type="text" class="js-flatpickr form-control bg-white" id="tgl_kegiatan" name="tgl_kegiatan" placeholder="Contoh: 09-04-2021" data-date-format="Y-m-d" data-id=minDateToday value="{{$kegiatan->tgl_kegiatan}}">
                            </div>
                            <div class="form-group">
                                <label>Jam Kegiatan</label>
                                <input type="text" class="js-flatpickr form-control bg-white" id="jam_kegiatan" name="jam_kegiatan" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" data-time_24hr="true" placeholder="Contoh: 19:00" value="{{$kegiatan->jam_kegiatan}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Pakaian</label>
                                <input type="text" class="form-control" name="pakaian" placeholder="Masukan Pakaian...." value="{{$kegiatan->pakaian}}">
                            </div>
                            <div class="form-group">
                                <label>Lokasi Kegiatan</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukan Lokasi Kegiatan...." value="{{$kegiatan->lokasi}}">
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
