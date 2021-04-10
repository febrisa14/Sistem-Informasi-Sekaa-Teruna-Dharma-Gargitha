@extends('component/app')

@section('content')

<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Data Jenis Kegiatan
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Jenis Kegiatan</li>
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
                <h3 class="block-title"><small>List Data</small> Jenis Kegiatan</h3>
                <a href="javascript:void(0)" id="addJenisKegiatan" class="btn btn-sm btn-alt-primary px-2 py-2">
                    <i class="fa fa-plus mr-1"></i> Add Jenis Kegiatan
                </a>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <div class="table-responsive">
                <table width="100%" class="table table-bordered js-dataTable-full-pagination" id="table-jenis-kegiatan">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th class="text-center">Nama Jenis Kegiatan</th>
                            <th class="text-center">Tanggal Dibuat</th>
                            <th width="21%" class="text-center">Action</th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
        <!-- Modal Page Add Pengurus -->
        <div class="modal fade" id="ModalJenisKegiatan" tabindex="-1" role="dialog" aria-labelledby="ModalJenisKegiatan" aria-hidden="true">
            <div class="modal-dialog modal-dialog-popin modal-dialog-center" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Add Jenis Kegiatan</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm">
                            <form id="jenisKegiatanForm" name="jenisKegiatanForm">
                                @csrf
                                <input type="hidden" name="jenis_kegiatan_id" id="jenis_kegiatan_id">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="jeniskegiatan">Nama Jenis Kegiatan</label>
                                            <input type="text" class="form-control" id="nama_jenis_kegiatan" name="nama_jenis_kegiatan" placeholder="Masukan Nama Jenis Kegiatan....">
                                            {{-- <small class="form-text text-muted">Contoh: contoh@gmail.com</small> --}}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="block-content block-content-full text-right border-top">
                            <button id="" type="submit" class="btn btn-alt-primary"><i class="fa fa-save"></i> Simpan</button>
                        </div> --}}
                        <div class="block-content block-content-full col-md-12">
                            <button id="saveBtn" type="submit" data-toggle="click-ripple" class="btn btn-block btn-outline-primary">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal Add Pengurus -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop
@push('scripts')

<script>

$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        $('#table-jenis-kegiatan').DataTable({
            paging: false,
            info: false,
            processing: true,
            serverSide: true,
            autowidth: true,
            searching: false,
            columnDefs: [
                {targets: 0, className: "text-center"},
                {targets: 1, className: "text-center"},
                {targets: 2, className: "text-center"},
                {targets: 3, className: "text-center"},
            ],
            ajax: '{{ route('admin.jenis_kegiatan.index') }}',
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama_jenis_kegiatan', name: 'nama_jenis_kegiatan', orderable: false, searchable: true},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    //Function untuk menampilkan modal ketika diklik tombol tambah
    $('#addJenisKegiatan').click(function () {
        $('#ModalJenisKegiatan').modal('show');
    });

    //Function untuk menambahkan data ke datatabase berelasi
    $('#saveBtn').click(function () {
        $.ajax({
            data: $('#jenisKegiatanForm').serialize(),
            url: "{{ route('admin.jenis_kegiatan.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#jenisKegiatanForm').trigger("reset");
                $('#ModalJenisKegiatan').modal('hide');
                var table = $('#table-jenis-kegiatan').DataTable();
                table.draw();
                // location.reload();
            },
            error: function(data) {
                $.each(data.responseJSON.errors, function (key, value) {
                    iziToast.error({
                    title: 'Error',
                    message: value,
                    position: 'bottomRight',
                    });
                });
            }
        });
    });

    $(document).on('click', '.delete', function (){
        var id = $(this).data("id");
        Swal.fire({
            title: 'Hapus Data Jenis Kegiatan?',
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
                    url: "{{ route('admin.jenis_kegiatan.destroy','') }}/"+id,
                    success: function (data) {
                        if (data.success == true)
                        {
                            Swal.fire('Deleted', data.message ,'success');
                        }
                        else if (data.success == false)
                        {
                            Swal.fire('Gagal', data.message ,'error');
                        }
                        var table = $('#table-jenis-kegiatan').DataTable();
                        table.draw();
                        // location.reload();
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
