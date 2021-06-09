@extends('component/app')

@section('content')
<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Detail Baju
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.baju.index') }}">Baju</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail Baju</li>
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
                    <form action="" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                    <div class="row items-push">
                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="nama">Nama Baju : </label>
                                <span>{{ $baju->nama_baju }}</span>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Baju</label>
                                <textarea class="form-control" name="deskripsi" rows="4">{{$baju->deskripsi}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="nama">Harga : </label>
                                <span>{{$baju->harga}}</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Foto Baju</label>
                                <div class="push">
                                    <img class="img" width="150" src="{{ asset('/baju/'.$baju->foto_baju) }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Regular -->
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop
