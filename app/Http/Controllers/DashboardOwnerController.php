<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Pendapatan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\KelolaOperasional;
use Illuminate\Support\Facades\DB;

class DashboardOwnerController extends Controller
{
    public function index()
    {
        $statusCounts = [
            'pending' => Checkout::where('status_pengiriman', 'pending')->count(),
            'dalam_perjalanan' => Checkout::where('status_pengiriman', 'dalam_perjalanan')->count(),
            'selesai' => Checkout::where('status_pengiriman', 'selesai')->count(),
            'perlu_dikirim' => Checkout::where('status_pengiriman', 'perlu_dikirim')->count(),
        ];

        $statusBayar = [
            'pending' => Checkout::where('status_pembayaran', 'pending')->count(),
            'disetujui' => Checkout::where('status_pembayaran', 'disetujui')->count()
        ];

        return view('owner.dashboard', compact('statusCounts', 'statusBayar'));
    }

    function laporan()
    {
        $riwayatPendapatan = Pendapatan::all();

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

            // get laba/rugi
            $labaRugi = $pendapatan->total_pendapatan - ($pengeluaran ? $pengeluaran->total_pengeluaran : 0);

            // laporan
            $laporanLabaRugiPerHari[] = [
                'tanggal' => $tanggal,
                'pendapatan' => $pendapatan->total_pendapatan,
                'pengeluaran' => $pengeluaran ? $pengeluaran->total_pengeluaran : 0,
                'laba_rugi' => $labaRugi
            ];
        }


        return view('owner.laporan', compact('riwayatPendapatan', 'laporanLabaRugiPerHari'));
    }

    public function rincianLaporan($tanggal)
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

        return view('owner.rincian', [
            'tanggal' => $tanggalFormatted,
            'pendapatan' => $pendapatan,
            'pengeluaran' => $pengeluaran,
            'totalPendapatan' => $totalPendapatan,
            'totalPengeluaran' => $totalPengeluaran,
            'labaRugi' => $totalPendapatan - $totalPengeluaran,
        ]);
    }
}
