<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Owner Dashboard</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="/frontend/admin_frontend/elaadmin/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet"
        href="/frontend/admin_frontend/elaadmin/assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="/frontend/admin_frontend/elaadmin/assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>

<body>
    @include('owner.sidebar')
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        @include('admin.header')
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->

                <!--  /Traffic -->
                <div class="clearfix"></div>
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-2">Kembali</a>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="box-title mb-2">Laporan Laba Rugi UD Wijoyo Mebel</h4>
                                    <h4>Tanggal {{ $tanggal }}</h4>

                                </div>

                                <div class="card-body">
                                    <h5><strong> 1. Pendapatan: </strong></h5>
                                    <ul class="list-group">
                                        @forelse ($pendapatan as $item)
                                            <li class="list-group-item d-flex justify-content-between">
                                                <div>
                                                    Transaksi Masuk [{{ $item->checkout->kode_transaksi }}]
                                                </div>
                                                <div class="ms-auto">
                                                    <span
                                                        class="text-end">{{ number_format($item->total_pendapatan, 2, ',', '.') }}</span>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="list-group-item text-muted">Tidak ada data pendapatan untuk
                                                tanggal ini.</li>
                                        @endforelse
                                    </ul>

                                    <div class="d-flex justify-content-between mt-2">
                                        <strong>Total Pendapatan:</strong>
                                        <span>Rp. {{ number_format($totalPendapatan, 2, ',', '.') }}</span>
                                    </div>

                                    <!-- Pengeluaran Section -->
                                    <div class="mt-4"></div>
                                    <h5><strong>2. Beban Pengeluaran</strong></h5>
                                    <ul class="list-group">
                                        @forelse ($pengeluaran as $item)
                                            <li class="list-group-item d-flex justify-content-between">
                                                <div>
                                                    {{ $item->kategoriOperasional->nama ?? '-' }}
                                                </div>
                                                <div class="ms-auto">
                                                    <span
                                                        class="text-end">{{ number_format($item->biaya, 2, ',', '.') }}</span>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="list-group-item text-muted">Tidak ada data pengeluaran untuk
                                                tanggal ini.</li>
                                        @endforelse
                                    </ul>

                                    <div class="d-flex justify-content-between mt-2">
                                        <strong>Total Pengeluaran:</strong>
                                        <span>Rp. {{ number_format($totalPengeluaran, 2, ',', '.') }}</span>
                                    </div>

                                    <div class="mt-4"></div>
                                    <h5 class="my-2"><strong>3. Laba dan Rugi:</strong></h5>
                                    @if ($labaRugi > 0)
                                        <h4 class="text-success text-right"><strong>Laba Bersih:</strong> Rp.
                                            {{ number_format($labaRugi, 2, ',', '.') }}</h4>
                                    @elseif ($labaRugi < 0)
                                        <h4 class="text-danger  text-right"><strong>Rugi Bersih:</strong> Rp.
                                            {{ number_format(abs($labaRugi), 2, ',', '.') }}</h4>
                                    @else
                                        <p class="text-muted"><strong>Break-Even Point:</strong> Tidak ada laba atau
                                            rugi.</p>
                                    @endif
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    @include('admin.footer')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="/frontend/admin_frontend/elaadmin/assets/js/main.js"></script>


    <script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="/frontend/admin_frontend/elaadmin/assets/js/init/datatables-init.js"></script>

</body>

</html>
