@extends('component/app')

@section('content')

<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Data Pengumuman
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Pengumuman</li>
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
                <h3 class="block-title"><small>List Data</small> Pengumuman</h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <div class="table-responsive">
                <table width="100%" class="table table-bordered js-dataTable-full-pagination" id="table-pengumuman">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Kegiatan</th>
                            <th>Jenis Kegiatan</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop
@push('scripts')

<script>

$(document).ready(function(){

    $(function() {
        $('#table-pengumuman').DataTable({
            // paging: false,
            // info: false,
            processing: true,
            serverSide: true,
            autowidth: true,
            searching: false,
            columnDefs: [
                {targets: 0, className: "text-center", width: "30px"},
                {targets: 1, className: "text-center", width: "145px"},
                {targets: 2, className: "text-center", width: "280px"},
                {targets: 3, className: "text-center", width: "150px"},
                {targets: 4, className: "text-center", width: "202px"},
            ],
            ajax: '{{ route('user.pengumuman.index') }}',
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'tgl_kegiatan', name: 'tgl_kegiatan'},
                {data: 'nama_kegiatan', name: 'nama_kegiatan', orderable: false, searchable: true},
                {data: 'nama_jenis_kegiatan', name: 'nama_jenis_kegiatan', orderable: false, searchable: true},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

});
</script>
@endpush
