<!DOCTYPE html>
<html>

<head>
    <title>Laporan Laba Rugi UD Wijoyo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
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
        }
    </style>
</head>

<body>
    <div class="header">
        Laporan Laba Rugi UD Wijoyo <br>
        Tanggal Cetak: {{ $tanggal_cetak }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Total Pendapatan</th>
                <th>Total Pengeluaran</th>
                <th>Laba Bersih</th>
                <th>Rugi Bersih</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $item)
                <tr>
                    <td>{{ $item['tanggal'] }}</td>
                    <td>Rp {{ number_format($item['pendapatan'], 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item['pengeluaran'], 0, ',', '.') }}</td>
                    <td>
                        @if ($item['laba_rugi'] >= 0)
                            Rp {{ number_format($item['laba_rugi'], 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($item['laba_rugi'] < 0)
                            Rp {{ number_format(abs($item['laba_rugi']), 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
