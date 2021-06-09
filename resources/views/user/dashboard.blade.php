    <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                    <div class="flex-sm-fill">
                        <h1 class="h3 font-w700 mb-2">
                            Anggota Dashboard
                        </h1>
                        <h2 class="h6 font-w500 text-muted mb-0">
                            Selamat Datang <strong>{{$nama}}</strong>, Anggota dari Tempekan {{Auth::User()->anggota->tempekan}}.
                        </h2>
                    </div>
                    {{-- <div class="mt-3 mt-sm-0 ml-sm-3">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn btn-sm btn-alt-primary" id="dropdown-analytics-overview" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-fw fa-calendar-alt"></i>
                                Last 30 days
                                <i class="fa fa-fw fa-angle-down"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right font-size-sm" aria-labelledby="dropdown-analytics-overview">
                                <a class="dropdown-item font-w500" href="javascript:void(0)">This Week</a>
                                <a class="dropdown-item font-w500" href="javascript:void(0)">Previous Week</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item font-w500" href="javascript:void(0)">This Month</a>
                                <a class="dropdown-item font-w500" href="javascript:void(0)">Previous Month</a>
                            </div>
                        </div>
                    </div> --}}
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
                                <dt class="font-size-h2 font-w700">{{$anggota->count()}}</dt>
                                <dd class="text-muted mb-0">Anggota</dd>
                            </dl>
                            <div class="item item-rounded bg-body">
                                <i class="fa fa-users font-size-h3 text-primary"></i>
                            </div>
                        </div>
                        <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                            <a class="font-w500 d-flex align-items-center" href="{{ route('user.anggota.index') }}">
                                Lihat Semua Anggota
                                <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                            </a>
                        </div>
                    </div>
                    <!-- END Anggota -->
                </div>
                <div class="col-sm-6 col-xl-3">
                    <!-- New Customers -->
                    <div class="block block-rounded d-flex flex-column">
                        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="font-size-h2 font-w700">{{$pengurus->count()}}</dt>
                                <dd class="text-muted mb-0">Pengurus</dd>
                            </dl>
                            <div class="item item-rounded bg-body">
                                <i class="fa fa-user-friends font-size-h3 text-primary"></i>
                            </div>
                        </div>
                        <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                            <a class="font-w500 d-flex align-items-center" href="">
                                Lihat Semua Pengurus
                                <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                            </a>
                        </div>
                    </div>
                    <!-- END New Customers -->
                </div>
                <div class="col-sm-6 col-xl-6">
                    <!-- Kas -->
                    <div class="block block-rounded d-flex flex-column">
                        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="font-size-h2 font-w700">Rp. {{number_format($saldo)}}</dt>
                                <dd class="text-muted mb-0">Saldo Kas ST. Dharma Gargitha</dd>
                            </dl>
                            <div class="item item-rounded bg-body">
                                <i class="fas fa-dollar-sign font-size-h3 text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <!-- END Anggota -->
                </div>
                {{-- <div class="col-sm-6 col-xl-3">
                    <!-- Messages -->
                    <div class="block block-rounded d-flex flex-column">
                        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="font-size-h2 font-w700">45</dt>
                                <dd class="text-muted mb-0">Messages</dd>
                            </dl>
                            <div class="item item-rounded bg-body">
                                <i class="fa fa-inbox font-size-h3 text-primary"></i>
                            </div>
                        </div>
                        <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                            <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                                View all messages
                                <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                            </a>
                        </div>
                    </div>
                    <!-- END Messages -->
                </div> --}}
                {{-- <div class="col-sm-6 col-xl-3">
                    <!-- Conversion Rate -->
                    <div class="block block-rounded d-flex flex-column">
                        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="font-size-h2 font-w700">4.5%</dt>
                                <dd class="text-muted mb-0">Conversion Rate</dd>
                            </dl>
                            <div class="item item-rounded bg-body">
                                <i class="fa fa-chart-line font-size-h3 text-primary"></i>
                            </div>
                        </div>
                        <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                            <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                                View statistics
                                <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                            </a>
                        </div>
                    </div>
                    <!-- END Conversion Rate-->
                </div> --}}
            </div>
            <!-- END Overview -->

            <!-- Pengumuman -->
            <div class="block block-rounded">
                <div class="block-header block-header-default bg-primary">
                    <h3 class="block-title text-white">Pengumuman</h3>
                </div>
                <div class="block-content">
                    <!-- Recent Orders Table -->
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter" id="table-pengumuman">
                            <thead>
                                <tr class="text-center">
                                    {{-- <th>No</th> --}}
                                    <th>Tanggal</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Jenis Kegiatan</th>
                                    <th width="200px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengumumans as $pengumuman)
                                    <tr>
                                        {{-- <td>{{$loop->iteration}}</td> --}}
                                        <td class="text-center">{{date('d M, Y', strtotime($pengumuman->tgl_kegiatan))}}</td>
                                        <td class="text-center">{{$pengumuman->nama_kegiatan}}</td>
                                        <td class="text-center">{{$pengumuman->nama_jenis_kegiatan}}</td>
                                        <td class="text-center"><a href="{{ route('user.pengumuman.show', ['id' => $pengumuman->kegiatan_id]) }}" class="detail btn btn-sm btn-danger"><i class="far fa-fw fa-eye"></i> Detail Pengumuman</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="4">Tidak Ada Pengumuman</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- END Recent Orders Table -->
                </div>
            </div>
            <!-- END Recent Orders -->

        </div>
        <!-- END Page Content -->
