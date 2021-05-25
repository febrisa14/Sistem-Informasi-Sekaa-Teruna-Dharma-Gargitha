@extends('component/app')

@section('content')

<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Pengeluaran
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Pengeluaran</li>
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
                <h3 class="block-title"><small>List Data</small> Pengeluaran</h3>
                @if (Auth::user()->pengurus->jabatan->nama_jabatan == 'Ketua STT' || Auth::user()->pengurus->jabatan->nama_jabatan == 'Wakil Ketua STT' || Auth::user()->pengurus->jabatan->nama_jabatan == 'Bendahara 1' || Auth::user()->pengurus->jabatan->nama_jabatan == 'Bendahara 2')
                <a href="{{route('admin.pengeluaran.create')}}" id="addAnggota" class="btn btn-sm btn-alt-primary px-2 py-2">
                    <i class="fa fa-plus mr-1"></i> Tambah Pengeluaran
                </a>
                @endIf
            </div>

            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <div class="table-responsive">
                    <table width="100%" class="table table-bordered js-dataTable-full-pagination" id="table-pengeluaran">
                        <thead class="thead-dark">
                            <tr>
                                <th>No. Tx</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                                <th>Nominal</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
        <!-- Fade In Block Modal -->
        <!-- Modal Anti Close Ketika Klik Asal Wajib Klik Tombol Close Untuk Keluar -->
        <div class="modal fade" id="lihat-pengeluaran" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-popin" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title">Detail pengeluaran</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option close-modal" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="140px"><b>No. Tx</b></td>
                                    <td>:</td>
                                    <td><span id="no_transaksi_kas"></span></td>
                                </tr>
                                <tr>
                                    <td><b>Tgl. Transaksi</b></td>
                                    <td>:</td>
                                    <td><span id="tgl_transaksi"></span></td>
                                </tr>
                                <tr>
                                    <td><b>Deskripsi</b></td>
                                    <td>:</td>
                                    <td><span id="deskripsi"></span></td>
                                </tr>
                                <tr>
                                    <td><b>Nominal</b></td>
                                    <td>:</td>
                                    <td><span id="nominal"></span></td>
                                </tr>
                                <tr>
                                    <td><b>Dibuat Oleh</b></td>
                                    <td>:</td>
                                    <td><span id="name"></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Fade In Block Modal -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop
@push('scripts')

<!-- Script Success SweetAlert2 -->
@if (Session::has('success'))
<script>
    Swal.fire('Success', '{{Session::get('success')}}' ,'success');
</script>
@endif

<script>

$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        $('#table-pengeluaran').DataTable({
            processing: true,
            serverSide: true,
            autowidth: true,
            columnDefs: [
                {targets: 0, className: "text-center", width: "120px"},
                {targets: 1, width: "90px"},
                {targets: 2, className: "text-center", width: "236px"},
                {targets: 3, className: "text-center", width: "82px"},
                {targets: 4, className: "text-center", width: "222px"},
            ],
            ajax: '{{ route('admin.pengeluaran.index') }}',
            columns: [
                {data: 'no_transaksi_kas', name: 'no_transaksi_kas', orderable: false},
                {data: 'tgl_transaksi', name: 'tgl_transaksi'},
                {data: 'deskripsi', name: 'deskripsi',orderable: false},
                {data: 'nominal', name: 'nominal', render: $.fn.dataTable.render.number('.')},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    $(document).on('click', '.detail', function(){
        var id = $(this).data("id");
        //modal show dan hanya bisa close ketika di klik tombol close
        $('#lihat-pengeluaran').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        });
        $.ajax ({
            url: "{{ route('admin.pengeluaran.show','') }}/" + id,
            type: 'GET',
            dataType: 'json',
            success: function (data){
                $("#no_transaksi_kas").html(data.pengeluaran.no_transaksi_kas);
                $("#tgl_transaksi").html(data.pengeluaran.tgl_transaksi);
                $("#deskripsi").html(data.pengeluaran.deskripsi);
                $("#nominal").html(data.pengeluaran.nominal);
                $("#name").html(data.pengeluaran.name);
            }
        });
    });

    $(document).on('click', '.delete', function (){
        var id = $(this).data("id");
        Swal.fire({
            title: 'Hapus Data Pengeluaran?',
            text: 'Klik "Iya" untuk menghapus data',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    type: "delete",
                    dataType: 'json',
                    url: "{{ route('admin.pengeluaran.destroy','') }}/"+id,
                    success: function (data) {
                        if (data.success == true)
                        {
                            Swal.fire('Deleted', data.message ,'success');
                        }
                        var table = $('#table-pengeluaran').DataTable();
                        table.draw();
                        // location.reload();
                    },
                    error: function (data) {
                        if (data.responseJSON)
                        {
                            Swal.fire('Error', 'Gagal Hapus Data pengeluaran', 'error')
                        }
                        var table = $('#table-pengeluaran').DataTable();
                        table.draw();
                    }
                });
            }
            // else {
            //     Swal.fire('Batal','Batal Menghapus Data Pengurus','error')
            // }
        });
    });

});

</script>
@endpush
