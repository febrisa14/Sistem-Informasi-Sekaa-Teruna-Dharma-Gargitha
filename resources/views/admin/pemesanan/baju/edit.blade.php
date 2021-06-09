@extends('component/app')

@section('content')
<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Ubah Data Baju
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.baju.index') }}">Baju</a></li>
                        <li class="breadcrumb-item" aria-current="page">Ubah Baju</li>
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
                    <h2 class="content-heading border-bottom mb-4 pb-2">Informasi Baju</h2>
                    <form action="{{ route('admin.baju.update',$baju->baju_id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                    <div class="row items-push">
                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="nama">Nama Baju</label>
                                <input type="text" class="form-control" name="nama_baju" value="{{ $baju->nama_baju }}">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Baju</label>
                                <textarea class="form-control" name="deskripsi" rows="2">{{$baju->deskripsi}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="nama">Harga</label>
                                <input type="text" class="form-control" name="harga" value="{{$baju->harga}}">
                            </div>
                            <div class="form-group">
                                <label for="nama">Tanggal Batas Order</label>
                                <input type="text" class="js-flatpickr form-control bg-white" name="tgl_batas_order" data-date-format="Y-m-d" value="{{$baju->tgl_batas_order}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Foto Baju</label>
                                <div class="push">
                                    <img class="img" width="150" src="{{ asset('/baju/'.$baju->foto_baju) }}" alt="">
                                </div>
                                <div class="custom-file">
                                    <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                    <input type="file" class="custom-file-input" data-toggle="custom-file-input" name="foto_baju">
                                    <label class="custom-file-label" for="one-profile-edit-avatar">Ubah foto baju</label>
                                </div>
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
