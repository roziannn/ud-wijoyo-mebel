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
                                    <strong class="card-title">Transaksi Customer</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode</th>
                                            <th>Detail</th>
                                            <th>Jumlah Bayar</th>
                                            <th width="5">Tanggal Pembayaran</th>
                                            <th>Status Pembayaran</th>
                                            <th>Status Approval</th>
                                            <th>Status Pengiriman</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($transaksi as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->kode_transaksi }}</td>
                                                <td>
                                                    <a href="{{ route('admin.transaksi-customer.show', $item->kode_transaksi) }}"
                                                        class="text-danger">Detail Transaksi</a>
                                                </td>
                                                <td>Rp {{ number_format($item->total_amount, 0, ',', '.') }}
                                                </td>
                                                <td>{{ $item->tanggal_pembayaran }}</td>
                                                <td>
                                                    <span
                                                        class="badge
                                                        @if ($item->payment_status === 'pending') badge-warning
                                                        @elseif ($item->payment_status === 'selesai')
                                                            badge-success p-2 @endif">
                                                        {{ ucfirst($item->payment_status) }}
                                                    </span>
                                                    @if ($item->payment_status === 'selesai')
                                                        <a href="{{ asset('storage/' . $item->bukti_bayar_img) }}" |
                                                            target="_blank" class="text-primary">Lihat Bukti Bayar</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge
                                                        @if ($item->status_pembayaran === 'pending') badge-warning
                                                        @elseif ($item->status_pembayaran === 'disetujui')
                                                            badge-success p-2 @endif">
                                                        {{ ucfirst($item->status_pembayaran) }}
                                                    </span>
                                                    @if ($item->status_pembayaran === 'pending' && $item->payment_status === 'selesai')
                                                        <form
                                                            action="{{ route('admin.transaksi-customer.approve', $item->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit"
                                                                class="text-primary btn btn-link">Setujui</button>
                                                        </form>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge p-2
                                                    @if ($item->status_pengiriman === 'dalam_perjalanan') badge-warning
                                                    @elseif ($item->status_pengiriman === 'selesai')
                                                        badge-success @endif">
                                                        {{ ucfirst($item->status_pengiriman) }} </span>
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
