<!doctype html>
<html class="no-js" lang="">
@include('admin.head')

<body>
    @include('admin.sidebar')

    <div id="right-panel" class="right-panel">
        @include('admin.header')
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Kategori Operasional</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Operasional</a></li>
                                    <li class="active">Kategori</li>
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
                                <div class="alert alert-warning mt-3"><strong>Digunakan untuk kategori pengeluaran
                                        operasional
                                        toko dan layanan</strong></div>
                                <div class="d-flex justify-content-between align">
                                    <strong class="card-title">Data Kategori Operasional</strong>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#addModal">
                                        Tambah Kategori
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Tgl dibuat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($datas as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-sm btn-warning btn-edit"
                                                        data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                                        data-toggle="modal" data-target="#editModal">
                                                        <i class="ti ti-pencil-alt"></i>
                                                    </a>

                                                    <a href="{{ route('admin.kategori-operasional.delete', $item->id) }}"
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
            </div>
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModal">Tambah Kategori</h5>
                        </div>
                        <form action="{{ route('admin.kategori-operasional.store') }}" method="POST">
                            <div class="modal-body">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="nama" class="form-label">Nama Kategori</label>
                                    <input type="text" name="nama" id="nama" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Kategori</h5>
                        </div>
                        <form method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="nama" class="form-label">Nama Kategori</label>
                                    <input type="text" name="nama" id="nama" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="clearfix">
        </div>

        @include('admin.footer')

    </div>


    @include('admin.script')

    <script>
        $(document).ready(function() {
            $(".btn-edit").on("click", function() {
                const id = $(this).data("id");
                const nama = $(this).data("nama");

                $("#editModal #nama").val(nama);
                $("#editModal form").attr("action", `/admin/kategori-operasional/update/${id}`);
            });
        });
    </script>
</body>

</html>
