<!DOCTYPE html>
<html>

<head>
    <title>Riwayat Pendapatan UD Wijoyo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;

        }

        table,
        th,
        td {
            border: 1px solid black;
            font-size: 12px;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        .header {
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        Riwayat Pendapatan UD Wijoyo <br>
        Tanggal Cetak: {{ $tanggalCetak }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Masuk</th>
                <th>Total Pendapatan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($riwayatPendapatan as $index => $pendapatan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($pendapatan->tanggal_masuk)->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($pendapatan->total_pendapatan, 0, ',', '.') }}</td>
                    <td>{{ $pendapatan->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
