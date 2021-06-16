@extends('component/app')

@section('content')
    <!-- Main Container -->
    <main id="main-container">

        <!-- Page Content -->
        <div class="content">

            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                    <!-- Product -->
                    <div class="block block-rounded">
                        <div class="block-content">
                            <div class="alert alert-success alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="alert-heading h5 my-1">Informasi</h3>
                                <p class="mb-0">Baju ini hanya dapat dipesan sampai tanggal <b>{{date('d M, Y', strtotime($baju->tgl_batas_order))}}</b> !</p>
                            </div>
                            <!-- Vitals -->
                            <div class="row items-push">
                                <div class="col-md-6">
                                    <!-- Images -->
                                    <!-- Magnific Popup (.js-gallery class is initialized in Helpers.magnific()) -->
                                    <!-- For more info and examples you can check out http://dimsemenov.com/plugins/magnific-popup/ -->
                                    <div class="row gutters-tiny js-gallery img-fluid-100">
                                        <div class="col-12 mb-3">
                                            <a class="img-link img-link-zoom-in img-lightbox" href="{{asset('/baju/'.$baju->foto_baju)}}">
                                                <img class="img-fluid" src="{{asset('/baju/'.$baju->foto_baju)}}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <!-- END Images -->
                                </div>
                                <div class="col-md-6">
                                    <!-- Info -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        {{-- <div>
                                            <div class="font-size-sm font-w600 text-success">IN STOCK</div>
                                            <div class="font-size-sm text-muted">Available</div>
                                        </div> --}}
                                        <div class="font-size-h2 font-w700">
                                            Rp. {{number_format($baju->harga)}}
                                        </div>
                                    </div>
                                    <p><b>{{$baju->nama_baju}}</b></p>
                                    <form class="d-flex justify-content-between my-3 border-top border-bottom" action="{{ route('user.order',$baju->baju_id) }}" method="post">
                                        @csrf
                                        <div class="py-3">
                                            <label>Size:</label>
                                            <select class="form-control form-control-sm" name="size" size="1">
                                                <option value="0" disabled selected>- Pilih -</option>
                                                <option value="M">M</option>
                                                <option value="L">L</option>
                                                <option value="XL">XL</option>
                                                <option value="XXL">XXL</option>
                                            </select>
                                        </div>
                                        <div class="py-3">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="fa fa-plus mr-1"></i> Pesan Baju
                                            </button>
                                        </div>
                                    </form>
                                    <label>Deskripsi</label>
                                    <textarea class="form-control bg-white" name="deskripsi" rows="5" readonly>{{$baju->deskripsi}}</textarea>
                                    <!-- END Info -->
                                </div>
                            </div>
                            <!-- END Vitals -->
                        </div>
                    </div>
                    <!-- END Product -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection

@push('scripts')

<!-- Script Error SweetAlert2 -->
@if (Session::has('error'))
<script>
    Swal.fire('Error', '{{ Session::get('error') }}' ,'error');
</script>
@endif

<!-- iziToast Error Tampil -->
@if ($errors->any)
    @foreach ($errors->all() as $message)
    <script>
        iziToast.error({
            title: 'Error',
            message: '{{ $message }}',
            position: 'bottomRight',
        });
    </script>
    @endforeach
@endif

@endpush
