<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
        }

        h2,
        h3 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .total {
            font-weight: bold;
        }

        .no-data {
            font-style: italic;
            color: gray;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Laporan Rincian Pendapatan</h2>
        <h3>Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</h3>

        <h4>1. Pendapatan</h4>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Transaksi Masuk</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pendapatan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>ID. [{{ $item->checkout->kode_transaksi }}]</td>
                        <td>Rp. {{ number_format($item->total_pendapatan, 2, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="no-data">Tidak ada data pendapatan untuk tanggal ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <p class="total">Total Pendapatan: Rp. {{ number_format($totalPendapatan, 2, ',', '.') }}</p>

        <!-- Pengeluaran -->
        <h4>2. Beban Pengeluaran</h4>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengeluaran as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->kategoriOperasional->nama }}</td>
                        <td>Rp. {{ number_format($item->biaya, 2, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="no-data">Tidak ada data pengeluaran untuk tanggal ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <p class="total">Total Pengeluaran: Rp. {{ number_format($totalPengeluaran, 2, ',', '.') }}</p>

        <h4>3. Laba dan Rugi</h4>
        <p class="total">Laba Bersih: Rp. {{ number_format($labaRugi, 2, ',', '.') }}</p>
    </div>

</body>

</html>
