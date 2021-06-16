@extends('component/app')

@section('content')

<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Data Kegiatan
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Kegiatan</li>
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
                <h3 class="block-title"><small>List Data</small> Kegiatan</h3>
                @if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Sekretaris 1' ||
                Auth::User()->pengurus->jabatan->nama_jabatan == 'Sekretaris 2' ||
                Auth::User()->pengurus->jabatan->nama_jabatan == 'Ketua STT' ||
                Auth::User()->pengurus->jabatan->nama_jabatan == 'Wakil Ketua STT')
                <a href="{{route('admin.kegiatan.create')}}" id="addKegiatan" class="btn btn-sm btn-alt-primary px-2 py-2">
                    <i class="fa fa-plus mr-1"></i> Tambah Kegiatan
                </a>
                @endif
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <div class="table-responsive">
                <table width="100%" class="table table-bordered js-dataTable-full-pagination" id="table-kegiatan">
                    <thead class="thead-dark">
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

    //function untuk disable past day flatpickr
    $(function() {
        $( "#tgl_kegiatan" ).flatpickr({minDate: 'today'});
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        $('#table-kegiatan').DataTable({
            paging: false,
            info: false,
            processing: true,
            serverSide: true,
            autowidth: true,
            searching: false,
            columnDefs: [
                {targets: 0, className: "text-center", width: "30px"},
                {targets: 1, className: "text-center", width: "120px"},
                {targets: 2, className: "text-center", width: "270px"},
                {targets: 3, className: "text-center", width: "145px"},
                {targets: 4, className: "text-center", width: "222px"},
            ],
            ajax: '{{ route('admin.kegiatan.index') }}',
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'tgl_kegiatan', name: 'tgl_kegiatan'},
                {data: 'nama_kegiatan', name: 'nama_kegiatan', orderable: false, searchable: true},
                {data: 'nama_jenis_kegiatan', name: 'nama_jenis_kegiatan', orderable: false, searchable: true},
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

    // //Function untuk menambahkan data ke datatabase berelasi
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
            title: 'Hapus Data Kegiatan?',
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
                    url: "{{ route('admin.kegiatan.destroy','') }}/"+id,
                    success: function (data) {
                        if (data.success == true)
                        {
                            Swal.fire('Deleted', data.message ,'success');
                        }
                        var table = $('#table-kegiatan').DataTable();
                        table.draw();
                        // location.reload();
                    }
                });
            }
        });
    });

});
</script>
@endpush
