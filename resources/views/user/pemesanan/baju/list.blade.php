@extends('component/app')

@section('content')

<!-- Main Container -->
<main id="main-container">

    <!-- Page Content -->
    <div class="content">

        <div class="row push">
            {{-- <div class="col-xl-4 order-xl-0">
                <!-- Categories -->
                <div class="block block-rounded js-ecom-div-nav d-none d-xl-block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-boxes text-muted mr-1"></i> Kategori
                        </h3>
                    </div>
                    <div class="block-content">
                        <ul class="nav nav-pills flex-column push">
                            <li class="nav-item mb-1">
                                <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                    Baju Ogoh - Ogoh <span class="badge badge-pill badge-secondary ml-1">2</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END Categories -->
            </div> --}}
            <div class="col-xl-12 order-xl-1">
                <!-- Products -->
                <div class="row row-deck">
                    @forelse ($baju as $baju)
                    <div class="col-md-6 col-xl-3">
                        <div class="block block-rounded">
                            <div class="options-container">
                                <img class="img-fluid options-item" src="{{asset('/baju/'.$baju->foto_baju)}}" alt="">
                                <div class="options-overlay bg-black-75">
                                    <div class="options-overlay-content">
                                        <a class="btn btn-sm btn-light" href="{{route('user.baju.show', ['id' => $baju->baju_id])}}">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="mb-2">
                                    <div class="h4 font-w600 text-success text-center">IDR {{number_format($baju->harga,2)}}</div>
                                    <a class="h4" href="{{route('user.baju.show', ['id' => $baju->baju_id])}}">{{$baju->nama_baju}}</a>
                                </div>
                                <p class="font-size-sm text-muted"></p>
                            </div>
                        </div>
                    </div>
                    @empty
                        Tidak Ada Baju Tersedia
                    @endforelse
                </div>
                <!-- END Products -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop
