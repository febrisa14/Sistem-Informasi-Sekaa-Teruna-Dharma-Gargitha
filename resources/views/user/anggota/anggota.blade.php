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
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Anggota</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">

        <!-- Overview -->
        <div class="row row-deck">
            <div class="col-sm-6 col-xl-3">
                <!-- Anggota -->
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="font-size-h2 font-w700">{{$tempekanKauh}}</dt>
                            <dd class="text-muted mb-0">Orang</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-users font-size-h3 text-primary"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <span class="font-w500 d-flex align-items-center">
                            Tempekan Kauh
                        </span>
                    </div>
                </div>
                <!-- END Anggota -->
            </div>
            <div class="col-sm-6 col-xl-3">
                <!-- New Customers -->
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="font-size-h2 font-w700">{{$tempekanKangin}}</dt>
                            <dd class="text-muted mb-0">Orang</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-users font-size-h3 text-success"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <span class="font-w500 d-flex align-items-center">
                            Tempekan Kangin
                        </span>
                    </div>
                </div>
                <!-- END New Customers -->
            </div>
            <div class="col-sm-6 col-xl-3">
                <!-- New Customers -->
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="font-size-h2 font-w700">{{$tempekanKubu}}</dt>
                            <dd class="text-muted mb-0">Orang</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-users font-size-h3 text-warning"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <span class="font-w500 d-flex align-items-center">
                            Tempekan Kubu
                        </span>
                    </div>
                </div>
                <!-- END New Customers -->
            </div>
        </div>
        <!-- END Overview -->

        <!-- Dynamic Table Full Pagination -->
        <div class="block block-rounded">
            <div class="block-header border-bottom">
                <h3 class="block-title"><small>List Data</small> Anggota</h3>
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
                        <thead class="thead-light">
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
                                    <td width="30px">:</td>
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
                {targets: 0, className: "text-center", width: "35px"},
                {targets: 1, width: "300px"},
                {targets: 2, className: "text-center", width: "122px"},
                {targets: 3, className: "text-center", width: "75px"},
                {targets: 4, className: "text-center", width: "66px"},
                {targets: 5, className: "text-center", width: "122px"},
            ],
            ajax: {
                url: '{{ route('user.anggota.index') }}',
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
            url: "{{ route('user.anggota.show','') }}/" + id,
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

});

</script>
@endpush
