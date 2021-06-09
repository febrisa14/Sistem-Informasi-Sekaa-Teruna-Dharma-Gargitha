@extends('component/app')

@section('content')

<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Tambah Pengurus
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.pengurus.index') }}">Pengurus</a></li>
                        <li class="breadcrumb-item" aria-current="page">Tambah Pengurus</li>
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
                <h3 class="block-title"><small>Pilih Data</small> Anggota</h3>
            </div>

            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <div class="table-responsive">
                    <table width="100%" class="table table-bordered js-dataTable-full-pagination" id="table-anggota">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Gender</th>
                                <th>Tempekan</th>
                                <th>Umur</th>
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
            ajax: '{{ route('admin.pengurus.create') }}',
            columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'jenis_kelamin', name: 'jenis_kelamin', orderable: false, searchable: true},
                  {data: 'tempekan', name: 'tempekan', orderable: false, searchable: true},
                  {data: 'umur', name: 'umur'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    $(document).on('click', '.pilih', function (){
        var id = $(this).data("id");
        Swal.fire({
            title: 'Jadikan Anggota Sebagai Pengurus?',
            text: 'Klik "Iya" untuk melanjutkan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: "{{ route('admin.pengurus.transfer','') }}/"+id,
                    success: function (data) {
                        if (data.success == true)
                        {
                            Swal.fire('Success', data.message ,'success');
                        }
                        else if (data.success == false)
                        {
                            Swal.fire('Gagal', data.message ,'error');
                        }
                        // var table = $('#table-pengurus').DataTable();
                        // table.draw();
                        // location.reload();
                        window.location.href = '/admin/pengurus'
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
