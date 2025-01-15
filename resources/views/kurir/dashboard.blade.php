<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kurir Dashboard</title>
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
    <link rel="stylesheet" href="/frontend/admin_frontend/elaadmin/assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    @include('kurir.sidebar')
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
                        <div class="col-xl-4 col-lg-6">
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h4 class="box-title mb-5 text-center">Grafik Monitoring Pengiriman</h4>
                                    <canvas id="statusPengirimanPie" width="250" height="300"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-6">
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h4 class="box-title">Tabel Monitoring Pengiriman Barang</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Status Pengiriman</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Pending</td>
                                                <td>{{ $statusCounts['pending'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Dalam Perjalanan</td>
                                                <td>{{ $statusCounts['dalam_perjalanan'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Selesai</td>
                                                <td>{{ $statusCounts['selesai'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Perlu Dikirim</td>
                                                <td>{{ $statusCounts['perlu_dikirim'] }}</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Total Semua</th>
                                                <th>{{ array_sum($statusCounts) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <style>
                    #statusPengirimanPie {
                        max-width: 300px;
                        max-height: 350px;
                        margin: 0 auto;
                    }
                </style>


                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const labels = ['Pending', 'Dalam Perjalanan', 'Selesai', 'Perlu Dikirim'];
                    const dataCounts = @json(array_values($statusCounts));

                    const ctx = document.getElementById('statusPengirimanPie').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Jumlah Pengiriman',
                                data: dataCounts,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.6)', // pending
                                    'rgba(54, 162, 235, 0.6)', // dalam Perjalanan
                                    'rgba(75, 192, 192, 0.6)', // selesai
                                    'rgba(255, 206, 86, 0.6)' // perlu dikirim
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(255, 206, 86, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true
                        }
                    });
                </script>

            </div>
        </div>
    </div>
    <!-- /.content -->
    <div class="clearfix"></div>
    <!-- Footer -->
    @include('admin.footer')
    <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="/frontend/admin_frontend/elaadmin/assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="/frontend/admin_frontend/elaadmin/assets/js/init/fullcalendar-init.js"></script>

</body>

</html>
