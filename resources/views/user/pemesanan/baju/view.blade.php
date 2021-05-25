@extends('component/app')

@section('content')
    <!-- Main Container -->
    <main id="main-container">

        <!-- Page Content -->
        <div class="content">
            <!-- Toggle Side Content -->
            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
            <div class="d-xl-none push">
                <div class="row gutters-tiny">
                    <div class="col-6">
                        <button type="button" class="btn btn-light btn-block" data-toggle="class-toggle" data-target=".js-ecom-div-nav" data-class="d-none">
                            <i class="fa fa-fw fa-bars text-muted mr-1"></i> Navigation
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-light btn-block" data-toggle="class-toggle" data-target=".js-ecom-div-cart" data-class="d-none">
                            <i class="fa fa-fw fa-shopping-cart text-muted mr-1"></i> Cart (3)
                        </button>
                    </div>
                </div>
            </div>
            <!-- END Toggle Side Content -->

            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                    <!-- Product -->
                    <div class="block block-rounded">
                        <div class="block-content">
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
                                        <div>
                                            <div class="font-size-sm font-w600 text-success">IN STOCK</div>
                                            <div class="font-size-sm text-muted">Available</div>
                                        </div>
                                        <div class="font-size-h2 font-w700">
                                            IDR {{number_format($baju->harga)}}
                                        </div>
                                    </div>
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
                                    @if ($baju->deskripsi != NULL)
                                        <p>{{$baju->deskripsi}}</p>
                                    @else
                                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                    @endif
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
