@extends('component/app')

@section('content')

<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Data Baju
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Data Baju</li>
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
                <h3 class="block-title"><small>List Data</small> Baju</h3>
                @if (Auth::user()->pengurus->jabatan->nama_jabatan == 'Ketua STT' || Auth::user()->pengurus->jabatan->nama_jabatan == 'Wakil Ketua STT' || Auth::user()->pengurus->jabatan->nama_jabatan == 'Bendahara 1' || Auth::user()->pengurus->jabatan->nama_jabatan == 'Bendahara 2')
                <a href="{{route('admin.baju.create')}}" class="btn btn-sm btn-alt-primary px-2 py-2">
                    <i class="fa fa-plus mr-1"></i> Tambah Baju
                </a>
                @endIf
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <div class="table-responsive">
                <table width="100%" class="table table-bordered js-dataTable-full-pagination" id="table-produk">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id. Baju</th>
                            <th>Nama Baju</th>
                            <th>Harga</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
        <!-- Modal Page Add Pengurus -->
        {{-- <div class="modal fade" id="ModalKegiatan" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-popin modal-dialog-center" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title">Add Kegiatan</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm">
                            <form id="KegiatanForm" name="KegiatanForm">
                                @csrf
                                <input type="hidden" name="kegiatan_id" id="kegiatan_id">
                                <input type="hidden" name="user_id" id="user_id">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Nama Kegiatan</label>
                                            <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" placeholder="Masukan Nama Kegiatan....">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Tanggal Kegiatan</label>
                                            <input type="text" class="js-flatpickr form-control bg-white" id="tgl_kegiatan" name="tgl_kegiatan" placeholder="Contoh: 09-04-2021" data-date-format="d-m-Y" data-id=minDateToday>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Jenis Kegiatan</label>
                                            <select class="custom-select" id="jenis_kegiatan_id" name="jenis_kegiatan_id">
                                                <option value="">- Pilih -</option>
                                                @forelse ($jeniskegiatans as $jeniskegiatan)
                                                    <option value="{{ $jeniskegiatan->jenis_kegiatan_id }}">{{ $jeniskegiatan->nama_jenis_kegiatan }}</option>
                                                @empty
                                                    <option value="">-- Kosong --</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Jam Kegiatan</label>
                                            <input type="text" class="js-flatpickr form-control bg-white" id="jam_kegiatan" name="jam_kegiatan" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" data-time_24hr="true" placeholder="Contoh: 19:00">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Pakaian</label>
                                            <input type="text" class="form-control" name="pakaian" placeholder="Masukan Pakaian....">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Lokasi Kegiatan</label>
                                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukan Lokasi Kegiatan....">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="block-content block-content-full col-md-12">
                            <button id="saveBtn" type="submit" data-toggle="click-ripple" class="btn btn-block btn-outline-primary">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- END Modal Add Pengurus -->
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

<script>

$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        $('#table-produk').DataTable({
            processing: true,
            serverSide: true,
            autowidth: true,
            columnDefs: [
                {targets: 0, className: "text-center", width: "70px"},
                {targets: 1, className: "text-center", width: "280px"},
                {targets: 2, className: "text-center", width: "120px"},
                {targets: 3, className: "text-center", width: "247px"},
            ],
            ajax: '{{ route('admin.baju.index') }}',
            columns: [
                {data: 'baju_id', name: 'baju_id', orderable: false},
                {data: 'nama_baju', name: 'nama_baju', orderable: false},
                {data: 'harga', name: 'harga', render: $.fn.dataTable.render.number('.')},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    //Function untuk menampilkan modal ketika diklik tombol tambah
    // $('#addKegiatan').click(function () {
    //     $('#ModalKegiatan').modal({
    //         show: true,
    //         backdrop: 'static',
    //         keyboard: false
    //     });
    // });

    //Function untuk menambahkan data ke datatabase berelasi
    // $('#saveBtn').click(function () {
    //     $.ajax({
    //         data: $('#KegiatanForm').serialize(),
    //         url: "{{ route('admin.kegiatan.store') }}",
    //         type: "POST",
    //         dataType: 'json',
    //         success: function (data) {
    //             $('#KegiatanForm').trigger("reset");
    //             $('#ModalKegiatan').modal('hide');
    //             Swal.fire('Success', data.message ,'success');
    //             var table = $('#table-kegiatan').DataTable();
    //             table.draw();
    //             // location.reload();
    //         },
    //         error: function(data) {
    //             $.each(data.responseJSON.errors, function (key, value) {
    //                 iziToast.error({
    //                 title: 'Error',
    //                 message: value,
    //                 position: 'bottomRight',
    //                 });
    //             });
    //         }
    //     });
    // });

    $(document).on('click', '.delete', function (){
        var id = $(this).data("id");
        Swal.fire({
            title: 'Hapus Data Baju?',
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
                    url: "{{ route('admin.baju.destroy','') }}/"+id,
                    success: function (data) {
                        if (data.success == true)
                        {
                            Swal.fire('Deleted', data.message ,'success');
                        }
                        var table = $('#table-produk').DataTable();
                        table.draw();
                        // location.reload();
                    },
                    error: function (data) {
                        if (data.responseJSON)
                        {
                            Swal.fire('Error', 'Gagal Hapus Data Baju', 'error')
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
