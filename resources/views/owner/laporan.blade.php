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
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="box-title">Laporan Laba Rugi UD Wijoyo Mebel</h4>
                                </div>
                                <div class="card-body">
                                    {{-- <h2>Laporan Laba Rugi per Hari</h2> --}}
                                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Total Pendapatan</th>
                                                <th>Total Pengeluaran</th>
                                                <th>Laba Bersih</th>
                                                <th>Rugi Bersih</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($laporanLabaRugiPerHari as $laporan)
                                                @php
                                                    $labaBersih = $laporan['pendapatan'] - $laporan['pengeluaran'];
                                                @endphp
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($laporan['tanggal'])->format('d-m-Y') }}
                                                    </td>
                                                    <td>Rp. {{ number_format($laporan['pendapatan'], 2, ',', '.') }}
                                                    </td>
                                                    <td>Rp. {{ number_format($laporan['pengeluaran'], 2, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        @if ($labaBersih > 0)
                                                            <span class="badge badge-success">
                                                                Rp. {{ number_format($labaBersih, 2, ',', '.') }}
                                                            </span>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($labaBersih < 0)
                                                            <span class="badge badge-danger">
                                                                Rp. {{ number_format(abs($labaBersih), 2, ',', '.') }}
                                                            </span>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('owner.laporan-rincian', $laporan['tanggal']) }}"
                                                            class="btn btn-info btn-sm">
                                                            Lihat Rincian
                                                        </a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <h4 class="box-title">Riwayat Pendapatan</h4>
                                    <hr>
                                    <table id="bootstrap-data-table2" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="5">#</th>
                                                <th>Tanggal / Jam Masuk</th>
                                                <th>Kode Transaksi</th>
                                                <th>Pendapatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayatPendapatan as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->created_at->format('d M Y, H:i:s') }}</td>
                                                    <td>{{ $item->checkout->kode_transaksi }}</td>
                                                    <td>Rp. {{ number_format($item->total_pendapatan, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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


    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table').DataTable();
            $('#bootstrap-data-table2').DataTable();
        });
    </script>
</body>

</html>
