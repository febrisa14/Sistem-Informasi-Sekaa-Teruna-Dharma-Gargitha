@extends('component/app')

@section('content')
<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Ubah Data Pesanan
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('user.pesanan') }}">Pesanan Saya</a></li>
                        <li class="breadcrumb-item" aria-current="page">Ubah Pesanan</li>
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

                    <h2 class="content-heading border-bottom mb-4 pb-2">Informasi Pemesanan</h2>
                    <form action="{{ route('user.pesanan.update',$pemesan->no_pesanan) }}" method="POST">
                        @method('PUT')
                        @csrf
                    <div class="row items-push">
                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="nama">Nama Pemesan</label>
                                <input type="text" class="form-control" name="anggota_id" value="{{ $pemesan->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pemesanan</label>
                                <input type="text" class="form-control" id="tgl_pesanan" name="tgl_pesanan" placeholder="Contoh: 09-04-2021" data-date-format="d-m-Y" data-id=minDateToday value="{{$pemesan->tgl_pesanan}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Baju</label>
                                <input type="text" class="form-control" name="baju_id" value="{{ $pemesan->nama_baju }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="tempekan">Size Baju</label>
                                <select class="custom-select" name="size">
                                    <option {{ $pemesan->size == "M" ? 'selected' : ''}} value="M">M</option>
                                    <option {{ $pemesan->size == "L" ? 'selected' : ''}} value="L">L</option>
                                    <option {{ $pemesan->size == "XL" ? 'selected' : ''}} value="XL">XL</option>
                                    <option {{ $pemesan->size == "XXL" ? 'selected' : ''}} value="XXL">XXL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama">Total Bayar</label>
                                <input type="text" class="form-control" name="harga" value="{{ $pemesan->total }}" readonly>
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
