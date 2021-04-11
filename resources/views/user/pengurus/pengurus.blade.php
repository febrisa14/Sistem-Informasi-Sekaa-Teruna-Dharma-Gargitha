@extends('component/app')

@section('content')

<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Data Pengurus
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Pengurus</li>
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
                <h3 class="block-title"><small>List Data</small> Pengurus</h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <div class="table-responsive">
                    <table width="100%" class="table table-bordered js-dataTable-full-pagination" id="table-pengurus">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th width="13%">Gender</th>
                                <th>Jabatan</th>
                                <th>Umur</th>
                                <th width="65px" class="text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
        <!-- Fade In Block Modal -->
        <!-- Modal Anti Close Ketika Klik Asal Wajib Klik Tombol Close Untuk Keluar -->
        <div class="modal fade" id="lihat-pengurus" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-popin" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title">Detail Pengurus</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option close-modal" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm">
                            <table class="table table-borderless">
                                <tr>
                                    <td style="text-align: center;" colspan="3"><img class="img-avatar" id="avatar" src="" alt=""></td>
                                </tr>
                                <tr>
                                    <td width="140px"><b>Nama Lengkap</b></td>
                                    <td>:</td>
                                    <td><span id="name"></span></td>
                                </tr>
                                <tr>
                                    <td><b>Jabatan</b></td>
                                    <td>:</td>
                                    <td><span id="jabatan"></span></td>
                                </tr>
                                <tr>
                                    <td><b>No. Telp</b></td>
                                    <td>:</td>
                                    <td><span id="no_telp"></span></td>
                                </tr>
                                <tr>
                                    <td><b>Tanggal Lahir</b></td>
                                    <td>:</td>
                                    <td><span id="tgl_lahir"></span></td>
                                </tr>
                                <tr>
                                    <td><b>Umur</b></td>
                                    <td>:</td>
                                    <td><span id="umur"></span></td>
                                </tr>
                                <tr>
                                    <td><b>Jenis Kelamin</b></td>
                                    <td>:</td>
                                    <td><span id="jenis_kelamin"></span></td>
                                </tr>
                                <tr>
                                    <td><b>Alamat</b></td>
                                    <td>:</td>
                                    <td><span id="alamat"></span></td>
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

<script>

$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(function() {
        $('#table-pengurus').DataTable({
            paging: false,
            info: false,
            processing: true,
            serverSide: true,
            autowidth: true,
            searching: false,
            columnDefs: [
                //buat rata tengah dari record umur dan action
                {targets: 0, className: "text-center"},
                {targets: 2, className: "text-center"},
                {targets: 3, className: "text-center"},
                {targets: 4, className: "text-center"},
                {targets: 5, className: "text-center"},
            ],
            ajax: '{{ route('user.pengurus.index') }}',
            columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'jenis_kelamin', name: 'jenis_kelamin', orderable: false, searchable: true},
                  {data: 'nama_jabatan', name: 'nama_jabatan', orderable: false, searchable: true},
                  {data: 'umur', name: 'umur'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
            ]
        });
    });

    $(document).on('click', '.detail', function(){
        var id = $(this).data("id");
        //modal show dan hanya bisa close ketika di klik tombol close
        $('#lihat-pengurus').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        });
        $.ajax ({
            url: "{{ route('user.pengurus.show','') }}/" + id,
            type: 'GET',
            dataType: 'json',
            success: function (data){
                $("#name").html(data.users.name);
                $("#jabatan").html(data.users.nama_jabatan);
                $("#no_telp").html(data.users.no_telp);
                $("#alamat").html(data.users.alamat);
                $("#tgl_lahir").html(data.users.tgl_lahir);
                $("#umur").html(data.users.umur);
                $("#jenis_kelamin").html(data.users.jenis_kelamin);
                $("#avatar").prop("src","{{ asset('/avatar/') }}"+'/'+data.users.avatar);
            }
        });
    });

});

</script>
@endpush
