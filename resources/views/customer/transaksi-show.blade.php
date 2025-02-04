@extends('layouts.master')
@section('contents')
    <div class="breadcrumbs mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('customer.home') }}">Home </a><i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="{{ route('customer.dashboard') }}">Dashboard</a><i
                                    class="ti-arrow-right"></i></li>
                            <li class="active"><a href="{{ route('customer.transaksi') }}">Transaksi</a><i
                                    class="ti-arrow-right"></i></li>
                            <li class="active"><a href="#">Detail Transaksi</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section-box">
        <div class="container">
            <div class="row">
                @include('customer.sidebar')
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-5">
                    <div class="content-single">
                        <h4 class="mb-0">Transaksi Detail</h4>

                        <hr>
                        <div class="dashboard_overview">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <p><strong>Kode Transaksi:</strong> {{ $transaksi->kode_transaksi }}</p>
                                            <p><strong>Total Amount:</strong> Rp
                                                {{ number_format($transaksi->total_amount, 0, ',', '.') }}</p>
                                            <p><strong>Payment Status:</strong> {{ ucfirst($transaksi->payment_status) }}
                                            </p>
                                            <p><strong>Alamat Pengiriman:</strong> {{ $transaksi->alamat_pengiriman }}</p>
                                            <p><strong>Status Pengiriman:</strong>
                                                {{ ucfirst($transaksi->status_pengiriman) }}</p>


                                            <h5 class="my-4">Detail Produk</h5>
                                            <table class="table table-bordered text-center">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Produk</th>
                                                        <th>Harga</th>
                                                        <th>Qty</th>
                                                        <th>Total Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($transaksi->details as $index => $detail)
                                                        <tr>
                                                            <td width="5">{{ $index + 1 }}</td>
                                                            <td>
                                                                <img src="{{ asset('storage/' . $detail->product->image) }}"
                                                                    alt="" width="100"
                                                                    class="mr-4">{{ $detail->product->nama ?? 'Produk tidak ditemukan' }}
                                                            </td>
                                                            <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                                            <td>{{ $detail->qty }}</td>
                                                            <td>Rp {{ number_format($detail->total_harga, 0, ',', '.') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            @if ($isPending && $currentDate <= $deadline)
                                                <div class="alert alert-danger">
                                                    <strong>Perhatian!</strong> Segera lakukan pembayaran dan unggah bukti
                                                    pembayaran sebelum tanggal
                                                    <strong>{{ $deadline->format('d M Y H:i') }} WIB</strong>

                                                    <h6 class="my-2">Informasi Transfer</h6>
                                                    <div class="info-bank">
                                                        <p class="text-dark mb-1"><strong>Bank Tujuan:</strong> BCA</p>
                                                        <p class="text-dark mb-1"><strong>Nomor Rekening:</strong> 329182009
                                                        </p>
                                                        <p class="text-dark mb-1"><strong>Atas Nama:</strong> UD WIJOYO
                                                            MEBEL
                                                            BERKAH JAYA</p>
                                                        <p class="text-dark"><strong>Catatan:</strong> <br> Harap sertakan
                                                            kode
                                                            transaksi
                                                            <strong>{{ $transaksi->kode_transaksi }}</strong> pada
                                                            kolom berita saat melakukan transfer.
                                                        </p>
                                                    </div>
                                                </div>
                                            @elseif ($isPending && $currentDate > $deadline)
                                                <div class="alert alert-danger">
                                                    <strong>Perhatian!</strong> Tenggat waktu pembayaran telah terlewati.
                                                    Hubungi layanan pelanggan untuk informasi lebih lanjut.
                                                </div>
                                            @endif

                                            <div class="card-footer text-right">
                                                <a href="{{ route('customer.transaksi') }}"
                                                    class="btn btn-secondary text-white">Kembali</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
