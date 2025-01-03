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
                            <li class="active"><a href="{{ route('customer.transaksi') }}">Transaksi</a></li>
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
                        <h4 class="mb-0">Transaksi Saya</h4>

                        <hr>
                        <div class="dashboard_overview">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            @if ($transaksi->isNotEmpty())
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>ID</th>
                                                            <th>Total Amount</th>
                                                            <th>Pembayaran</th>
                                                            <th>Status Pengiriman</th>
                                                            <th>Detail Pembelian</th>
                                                            <th>Pembayaran</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $i = 1; // Inisialisasi variabel untuk nomor urut
                                                        @endphp
                                                        @foreach ($transaksi as $item)
                                                            <tr>
                                                                <td>{{ $i++ }}</td>
                                                                <td>{{ $item->kode_transaksi }}</td>
                                                                <td>Rp {{ number_format($item->total_amount, 0, ',', '.') }}
                                                                </td>
                                                                <td>{{ ucfirst($item->payment_status) }}</td>
                                                                <td>{{ ucfirst($item->status_pengiriman) }}</td>
                                                                <td><a href="{{ route('customer.transaksi.show', $item->id) }}"
                                                                        class="text-danger">Detail</a> </td>
                                                                <td>


                                                                    @if ($item->payment_status === 'selesai' && $item->status_pembayaran === 'pending')
                                                                        <span class="badge badge-warning">Berhasil bayar.
                                                                            <br> Menuggu konfirmasi
                                                                            admin</span>
                                                                    @elseif ($item->payment_status === 'selesai' && $item->status_pembayaran === 'disetujui')
                                                                        <span class="badge badge-success">Pembayaran
                                                                            telah disetujui</span>
                                                                    @else
                                                                        <a class="text-primary" data-toggle="modal"
                                                                            data-target="#uploadBuktiModal{{ $item->id }}"
                                                                            style="cursor: pointer">
                                                                            Upload Bukti Transfer</a>
                                                                    @endif


                                                                    <div class="modal fade"
                                                                        id="uploadBuktiModal{{ $item->id }}"
                                                                        tabindex="-1"
                                                                        aria-labelledby="uploadBuktiModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog ">
                                                                            <div class="modal-content">
                                                                                <form
                                                                                    action="{{ route('customer.transaksi.store', $item->id) }}"
                                                                                    method="POST"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="uploadBuktiModalLabel">
                                                                                            Upload Bukti Transfer Kode Beli:
                                                                                            {{ $item->kode_transaksi }}
                                                                                        </h5>
                                                                                        <button type="button"
                                                                                            class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="mb-3">
                                                                                            <label for="buktiBayar"
                                                                                                class="form-label">Pilih
                                                                                                Gambar Bukti
                                                                                                Transfer</label>
                                                                                            <input type="file"
                                                                                                class="form-control"
                                                                                                id="buktiBayar"
                                                                                                name="bukti_bayar_img"
                                                                                                accept="image/*" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">Batal</button>
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary">Upload</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <p class="text-center">Tidak ada riwayat transaksi.</p>
                                            @endif
                                        </div>

                                        <div class="card-footer">
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
