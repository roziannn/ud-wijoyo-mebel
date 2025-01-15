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
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->kategoriOperasional->nama }}</td>
                                                <td>{{ $item->biaya }}</td>
                                                <td>{{ $item->deskripsi }}</td>
                                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-sm btn-warning btn-edit"
                                                        data-id="{{ $item->id }}"
                                                        data-kategori-id="{{ $item->kategori_operasional_id }}"
                                                        data-biaya="{{ $item->biaya }}"
                                                        data-deskripsi="{{ $item->deskripsi }}"
                                                        data-tanggal="{{ $item->created_at->format('Y-m-d') }}"
                                                        data-toggle="modal" data-target="#editModal">
                                                        <i class="ti ti-pencil-alt"></i>
                                                    </a>

                                                    <a href="{{ route('admin.data-kategori.delete', $item->id) }}"
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
                            <h5 class="modal-title" id="addModal">Tambah Pengeluaran</h5>
                        </div>
                        <form action="{{ route('admin.kelola-operasional.store') }}" method="POST">
                            <div class="modal-body">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="tanggal_pengeluaran" class="form-label">Tanggal Pengeluaran</label>
                                    <input type="date" name="tanggal_pengeluaran" id="tanggal_pengeluaran"
                                        class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_kategori_operasional" class="form-label">Kategori Pengeluaran</label>
                                    <select name="id_kategori_operasional" id="id_kategori_operasional"
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
                            <h5 class="modal-title" id="editModalLabel">Edit Pengeluaran</h5>
                        </div>
                        <form method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="tanggal_pengeluaran" class="form-label">Tanggal Pengeluaran</label>
                                    <input type="date" name="tanggal_pengeluaran" id="tanggal_pengeluaran"
                                        class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_kategori_operasional" class="form-label">Kategori
                                        Pengeluaran</label>
                                    <select name="id_kategori_operasional" id="id_kategori_operasional"
                                        class="form-control" required>
                                        <option value="" disabled selected>Pilih Kategori Pengeluaran</option>
                                        @foreach ($kategori_operasional as $kategori)
                                            <option value="{{ $kategori->id }}"
                                                {{ $kategori->id == $item->id_kategori_operasional ? 'selected' : '' }}>
                                                {{ $kategori->nama }}
                                            </option>
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
                const kategori_id = $(this).data("kategori-id");
                const biaya = $(this).data("biaya");
                const deskripsi = $(this).data("deskripsi");
                const tanggal_pengeluaran = $(this).data("tanggal");

                $("#editModal #tanggal_pengeluaran").val(tanggal_pengeluaran);
                $("#editModal #id_kategori_operasional").val(kategori_id);
                $("#editModal #biaya").val(biaya);
                $("#editModal #deskripsi").val(deskripsi);

                $("#editModal form").attr("action", `/admin/kelola-operasional/update/${id}`);
            });
        });
    </script>
</body>

</html>
