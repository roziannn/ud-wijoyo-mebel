<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
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
    @include('admin.sidebar')

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">
        @include('admin.header')
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Data Produk</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Master Data</a></li>
                                    <li class="active">Data Produk</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align">
                                    <strong class="card-title">Data Produk Mebel</strong>
                                    <a href="{{ route('admin.data-produk.create') }}"
                                        class="btn btn-sm btn-primary">Tambah Produk</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Jenis Ruangan</th>
                                            <th>Stock</th>
                                            <th>Harga</th>
                                            <th>Rating</th>
                                            <th>Tgl dibuat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($products as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->kategori }}</td>
                                                <td>{{ $item->jenis_ruangan }}</td>
                                                <td>{{ $item->stock }}</td>
                                                <td>{{ $item->harga }}</td>
                                                <td>{{ $item->rating }}</td>
                                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.data-produk.edit', $item->slug) }}"
                                                        class="btn btn-sm btn-warning"><i
                                                            class="ti ti-pencil-alt"></i></a>
                                                    <a href="{{ route('admin.data-produk.delete', $item->id) }}"
                                                        class="btn btn-sm btn-danger delete-item"><i
                                                            class="ti ti-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


        <div class="clearfix"></div>

        @include('admin.footer')

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

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
            $('#bootstrap-data-table-export').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".delete-item").on('click', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: 'Data yang terhapus tidak dapat dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus data!',
                }).then((result) => {
                    if (result
                        .isConfirmed
                    ) { // isConfirmed untuk mengecek apakah tombol konfirmasi ditekan
                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                window.location.reload();
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr);
                                Swal.fire(xhr.responseJSON
                                    .message, {
                                        icon: 'error',
                                    });
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
