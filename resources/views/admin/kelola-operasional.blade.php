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
                                <h1>Kelola Operasional</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Operasional</a></li>
                                    <li class="active">Kelola Operasional</li>
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
                                    <strong class="card-title">Data Pengeluaran Operasional</strong>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#addModal">
                                        Tambah Pengeluaran
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kategori Pengeluaran</th>
                                            <th>Biaya</th>
                                            <th>Deskripsi</th>
                                            <th>Tgl pengeluaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
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
                            <h5 class="modal-title" id="addModal">Tambah Pengeluaran</h5>
                        </div>
                        <form action="{{ route('admin.data-ruangan.store') }}" method="POST">
                            <div class="modal-body">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="tanggal_pengeluaran" class="form-label">Tanggal Pengeluaran</label>
                                    <input type="date" name="tanggal_pengeluaran" id="tanggal_pengeluaran"
                                        class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_kategori_pengeluaran" class="form-label">Kategori Pengeluaran</label>
                                    <select name="id_kategori_pengeluaran" id="id_kategori_pengeluaran"
                                        class="form-control" required>
                                        <option value="" disabled selected>Pilih Kategori Pengeluaran</option>
                                        @foreach ($kategori_operasional as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="biaya" class="form-label">Biaya dalam angka Rupiah</label>
                                    <input type="text" name="biaya" id="biaya" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea type="text" name="deskripsi" id="deskripsi" class="form-control"></textarea>
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
                            <h5 class="modal-title" id="editModalLabel">Edit Ruangan</h5>
                        </div>
                        <form method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="nama" class="form-label">Nama Ruangan</label>
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
                $("#editModal form").attr("action", `/admin/data-ruangan/update/${id}`);
            });
        });
    </script>
</body>

</html>
