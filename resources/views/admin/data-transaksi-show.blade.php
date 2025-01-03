<!doctype html>
<html class="no-js" lang=""> <!--<![endif]-->
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
                                <h1>Transaksi Customer</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Transaksi Customer</a></li>
                                    <li><a href="#">Detail</a></li>
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
                                    <strong class="card-title">Detail Transaksi ID:
                                        {{ $transaksi->kode_transaksi }}</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="mb-3 text-secondary"><strong>Customer</strong></h4>
                                <p>Nama Customer: {{ $transaksi->customer->nama_lengkap }}</p>
                                <p>Nomor Telepon: {{ $transaksi->customer->no_telp }}</p>
                                <p>Alamat Kirim: {{ $transaksi->alamat_pengiriman }}</p>
                            </div>
                            <div class="card-body">
                                <h4 class="mb-3 text-secondary"><strong>Pembayaran</strong></h4>
                                <p>Status Pembayaran:
                                    @if ($transaksi->payment_status === 'selesai' && $transaksi->status_pembayaran === 'pending')
                                        <span class="badge badge-success">Sudah Bayar</span>
                                        <span class="badge badge-warning">Butuh approve admin</span>
                                        <a href="{{ asset('storage/' . $transaksi->bukti_bayar_img) }}" |
                                            target="_blank" class="text-primary">Lihat Bukti Bayar</a>
                                </p>
                            @elseif ($transaksi->payment_status === 'pending' && $transaksi->status_pembayaran === 'pending')
                                <span class="badge badge-danger">Belum dibayar</span>
                            @elseif ($transaksi->payment_status === 'selesai' && $transaksi->status_pembayaran === 'disetujui')
                                <span class="badge badge-primary">Pembayaran telah disetujui Admin.</span>
                                @endif
                                </p>
                                <p>
                                <p>Tanggal Pembayaran: {{ $transaksi->tanggal_pembayaran }}</p>

                                <p>Pengiriman: {{ $transaksi->status_pengiriman }}</p>
                            </div>
                            <div class="card-body">
                                <h4 class="mb-3 text-secondary"><strong>Barang yang perlu dikirim</strong></h4>

                                @foreach ($transaksi->details as $detail)
                                    <div class="d-flex mb-3 align-items-center">
                                        <img src="{{ asset('storage/' . $detail->product->image) }}"
                                            alt="{{ $detail->product->nama ?? 'Produk tidak ditemukan' }}"
                                            width="200" class="mr-3">
                                        <div>
                                            <h5 class="mb-1">{{ $detail->product->nama ?? 'Produk tidak ditemukan' }}
                                            </h5>
                                            <p class="mb-1">Harga: Rp
                                                {{ number_format($detail->harga, 0, ',', '.') }}</p>
                                            <p class="mb-1">Jumlah Barang: {{ $detail->qty }}</p>
                                            <p>Total Harga: Rp {{ number_format($detail->total_harga, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        < <div class="clearfix">
    </div>

    @include('admin.footer')

    </div>


    @include('admin.script')

    {{-- <script>
        $(document).ready(function() {
            $(".btn-edit").on("click", function() {
                const id = $(this).data("id");
                const nama = $(this).data("nama");

                $("#editModal #nama").val(nama);
                $("#editModal form").attr("action", `/admin/data-ruangan/update/${id}`);
            });
        });
    </script> --}}
</body>

</html>
