<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\KelolaOperasional;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    public function downloadLaporan()
    {

        $pendapatanPerHari = DB::table('pendapatans')
            ->join('checkouts', 'pendapatans.id_checkout', '=', 'checkouts.id')
            ->select(
                DB::raw('DATE(pendapatans.tanggal_masuk) as tanggal'),
                DB::raw('SUM(pendapatans.total_pendapatan) as total_pendapatan')
            )
            ->groupBy(DB::raw('DATE(pendapatans.tanggal_masuk)'))
            ->orderBy('tanggal', 'asc')
            ->get();


        $pengeluaranPerHari = DB::table('kelola_operasionals')
            ->join('kategori_operasionals', 'kelola_operasionals.id_kategori_operasional', '=', 'kategori_operasionals.id')
            ->select(
                DB::raw('DATE(kelola_operasionals.tanggal_pengeluaran) as tanggal'),
                DB::raw('SUM(kelola_operasionals.biaya) as total_pengeluaran')
            )
            ->groupBy(DB::raw('DATE(kelola_operasionals.tanggal_pengeluaran)'))
            ->orderBy('tanggal', 'asc')
            ->get();

        $laporanLabaRugiPerHari = [];
        foreach ($pendapatanPerHari as $pendapatan) {
            $tanggal = $pendapatan->tanggal;
            $pengeluaran = $pengeluaranPerHari->firstWhere('tanggal', $tanggal);
            $labaRugi = $pendapatan->total_pendapatan - ($pengeluaran ? $pengeluaran->total_pengeluaran : 0);

            $laporanLabaRugiPerHari[] = [
                'tanggal' => $tanggal,
                'pendapatan' => $pendapatan->total_pendapatan,
                'pengeluaran' => $pengeluaran ? $pengeluaran->total_pengeluaran : 0,
                'laba_rugi' => $labaRugi
            ];
        }

        $pdf = Pdf::loadView('pdf.laporanLabaRugi-all', [
            'laporan' => $laporanLabaRugiPerHari,
            'tanggal_cetak' => Carbon::now('Asia/Jakarta')->format('d F Y')
        ]);

        return $pdf->download('Laporan_Laba_Rugi.pdf');
    }

    public function downloadRiwayatPendapatan()
    {
        $riwayatPendapatan = Pendapatan::all();

        $tanggalCetak = Carbon::now('Asia/Jakarta')->format('d F Y');

        $pdf = Pdf::loadView('pdf.riwayatPendapatan', compact('riwayatPendapatan', 'tanggalCetak'));

        return $pdf->download('Riwayat_Pendapatan.pdf');
    }

    public function rincianLaporanPDF($tanggal)
    {
        $tanggalFormatted = Carbon::parse($tanggal)->format('Y-m-d');

        $pendapatan = Pendapatan::with('checkout')
            ->whereDate('tanggal_masuk', $tanggalFormatted)
            ->get();

        $pengeluaran = KelolaOperasional::with('kategoriOperasional')
            ->whereDate('tanggal_pengeluaran', $tanggalFormatted)
            ->get();

        $totalPendapatan = $pendapatan->sum('total_pendapatan');
        $totalPengeluaran = $pengeluaran->sum('biaya');
        $labaRugi = $totalPendapatan - $totalPengeluaran;

        $data = [
            'tanggal' => $tanggalFormatted,
            'pendapatan' => $pendapatan,
            'pengeluaran' => $pengeluaran,
            'totalPendapatan' => $totalPendapatan,
            'totalPengeluaran' => $totalPengeluaran,
            'labaRugi' => $labaRugi,
        ];

        $pdf = Pdf::loadView('pdf.rincianLaporan', $data);
        return $pdf->download('rincian_laporan_' . $tanggalFormatted . '.pdf');
    }
}
