@extends('layouts.master')
@section('contents')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Cara Pembayaran</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container my-5">
        <h2 class="pb-3">Pembelian dan Pembayaran di UD Wijoyo Mebel</h2>

        <p><strong>🛒 1. Pilih Produk yang Diinginkan</strong><br>
            Jelajahi katalog kami dan pilih produk furnitur yang Anda inginkan.
            Klik <em>"Tambah ke Keranjang"</em> untuk memasukkan produk ke dalam daftar belanja Anda.
        </p>

        <p><strong>🛍️ 2. Checkout & Konfirmasi Pesanan</strong><br>
            Setelah memilih produk, masuk ke halaman <em>Keranjang</em> dan periksa kembali daftar belanja Anda.
            Klik <em>"Checkout"</em>, lalu <strong>pastikan informasi pengiriman</strong> seperti alamat lengkap dan nomor
            kontak sudah benar.
        </p>

        <p><strong>📤 3. Upload Bukti Pembayaran</strong><br>
            Setelah checkout, lakukan pembayaran sesuai dengan total yang tertera.
            Transfer ke rekening yang telah disediakan <strong>(hanya atas nama UD WIJOYO)</strong>.
            Setelah pembayaran berhasil, upload bukti pembayaran pada halaman yang disediakan.
        </p>
        <p><strong>✅ 4. Konfirmasi Pembayaran oleh Admin</strong><br>
            Admin akan memverifikasi bukti pembayaran yang telah diunggah.
            Harap menunggu maksimal <strong>1 x 24 jam</strong> untuk proses verifikasi.
        </p>

        <p><strong>🚚 5. Pengiriman Pesanan</strong><br>
            Setelah pembayaran dikonfirmasi, pesanan akan segera diproses dan dikirim ke alamat yang telah Anda berikan.
        </p>


        <div class="alert alert-warning my-3">
            <i class="ti ti-info me-2"></i> Jika terjadi keterlambatan atau kendala dalam pembayaran,
            silakan konfirmasi melalui WhatsApp Admin Toko yang aktif.
        </div>

    </section>
@endsection

</style>
