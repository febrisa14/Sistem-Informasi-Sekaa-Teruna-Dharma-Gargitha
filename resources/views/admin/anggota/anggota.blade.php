@extends('component/app')

@section('content')

<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Data Anggota
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Anggota</li>
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
                <h3 class="block-title"><small>List Data</small> Anggota</h3>
                <a href="{{ route('admin.anggota.create') }}" id="addAnggota" class="btn btn-sm btn-alt-primary px-2 py-2">
                    <i class="fa fa-plus mr-1"></i> Add Anggota
                </a>
            </div>

            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <div class="row">
                    <div class="col-3">
                        <div class="form-group font-size-sm">
                            <label>Filter Tempekan:</label>
                            <select class="form-control" name="filter_tempekan" id="filter_tempekan">
                                <option value="">- Pilih -</option>
                                <option value="Kauh">Kauh</option>
                                <option value="Kangin">Kangin</option>
                                <option value="Kubu">Kubu</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table width="100%" class="table table-bordered js-dataTable-full-pagination" id="table-anggota">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Gender</th>
                                <th>Tempekan</th>
                                <th>Umur</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
        <!-- Fade In Block Modal -->
        <!-- Modal Anti Close Ketika Klik Asal Wajib Klik Tombol Close Untuk Keluar -->
        <div class="modal fade" id="lihat-anggota" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-popin" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title">Detail Anggota</h3>
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
                                    <td><b>Tempekan</b></td>
                                    <td>:</td>
                                    <td><span id="tempekan"></span></td>
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

    fetch_data();

    function fetch_data(tempekan = '')
    {
        var table_anggota = $('#table-anggota').DataTable({
            processing: true,
            serverSide: true,
            autowidth: true,
            columnDefs: [
                {targets: 0, className: "text-center", width: "32px"},
                {targets: 1, width: "224px"},
                {targets: 2, className: "text-center", width: "94px"},
                {targets: 3, className: "text-center", width: "104px"},
                {targets: 4, className: "text-center", width: "60px"},
                {targets: 5, className: "text-center", width: "232px"},
            ],
            ajax: {
                url: '{{ route('admin.anggota.index') }}',
                data: {tempekan:tempekan}
            },
            columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'jenis_kelamin', name: 'jenis_kelamin', orderable: false, searchable: true},
                  {data: 'tempekan', name: 'tempekan', orderable: false, searchable: true},
                  {data: 'umur', name: 'umur'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    }

    $('#filter_tempekan').change(function(){
        var tempekan = $('#filter_tempekan').val();
        $('#table-anggota').DataTable().destroy();
        fetch_data(tempekan);
    });

    $(document).on('click', '.detail', function(){
        var id = $(this).data("id");
        //modal show dan hanya bisa close ketika di klik tombol close
        $('#lihat-anggota').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        });
        $.ajax ({
            url: "{{ route('admin.anggota.show','') }}/" + id,
            type: 'GET',
            dataType: 'json',
            success: function (data){
                $("#name").html(data.users.name);
                $("#tempekan").html(data.users.tempekan);
                $("#no_telp").html(data.users.no_telp);
                $("#alamat").html(data.users.alamat);
                $("#tgl_lahir").html(data.users.tgl_lahir);
                $("#umur").html(data.users.umur);
                $("#jenis_kelamin").html(data.users.jenis_kelamin);
                $("#avatar").prop("src","{{ asset('/avatar/') }}"+'/'+data.users.avatar);
            }
        });
    });

    $(document).on('click', '.delete', function (){
        var id = $(this).data("id");
        Swal.fire({
            title: 'Hapus Data Anggota?',
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
                    url: "{{ route('admin.anggota.destroy','') }}/"+id,
                    success: function (data) {
                        if (data.success == true)
                        {
                            Swal.fire('Deleted', data.message ,'success');
                        }
                        else if (data.success == false)
                        {
                            Swal.fire('Gagal', data.message ,'error');
                        }
                        var table = $('#table-anggota').DataTable();
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
