@extends('component/app')

@section('content')

<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Cetak Laporan Kas
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Cetak Laporan Kas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">

        <!-- Dynamic Table Full Pagination -->
        <div class="block block-rounded">
            <div class="block-header border-bottom">
                <h3 class="block-title"><small>Halaman Cetak</small> Laporan Kas</h3>
            </div>

            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <input type="text" class="js-flatpickr form-control bg-white" id="tglawal" name="tglawal" placeholder="Y-m-d" data-date-format="Y-m-d" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="text" class="js-flatpickr form-control bg-white" id="tglakhir" name="tglakhir" placeholder="Y-m-d" data-date-format="Y-m-d" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <a
                        onclick="return validate()" target="_blank"
                        data-toggle="click-ripple" class="btn btn-primary">
                            <i class="fa fa-print mr-1"></i> Cetak Laporan Kas
                        </a>
                    </div>
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
        </div>
        {{-- this.href='/admin/kas/laporan/cetak/'+ document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value --}}
        <!-- END Dynamic Table Full Pagination -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop
@push('scripts')
<script>
    function validate(input)
    {
        if(document.getElementById("tglawal").value == 0 || document.getElementById('tglakhir').value == 0)
        {
            iziToast.error({
            title: 'Error',
            message: 'Tanggal Tidak Boleh Kosong',
            position: 'bottomRight',
            });
        }
        else
        {
            window.location.href ='/admin/kas/laporan/cetak/'+ document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value
        }
    }
</script>
@endpush
