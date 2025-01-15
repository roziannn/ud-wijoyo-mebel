<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flasher\Laravel\Facade\Flasher;

class DashboardKurirController extends Controller
{
    public function index()
    {
        $statusCounts = [
            'pending' => Checkout::where('status_pengiriman', 'pending')->count(),
            'dalam_perjalanan' => Checkout::where('status_pengiriman', 'dalam_perjalanan')->count(),
            'selesai' => Checkout::where('status_pengiriman', 'selesai')->count(),
            'perlu_dikirim' => Checkout::where('status_pengiriman', 'perlu_dikirim')->count(),
        ];

        return view('kurir.dashboard', compact('statusCounts'));
    }


    function perluDikirim()
    {
        $data = Checkout::where('status_pengiriman', 'perlu_dikirim')->get();

        $dalamPerjalanan = Checkout::where('status_pengiriman', 'dalam_perjalanan')->get();

        // dd($data);
        return view('kurir.perlu-dikirim', compact('data', 'dalamPerjalanan'));
    }


    function riwayat()
    {
        $data = Checkout::where('status_pengiriman', 'selesai')->get();

        // dd($data);
        return view('kurir.riwayat-pengiriman', compact('data'));
    }

    public function kirimBarang($id)
    {
        $checkout = Checkout::find($id);

        if (!$checkout) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $checkout->status_pengiriman = 'dalam_perjalanan';
        $checkout->save();

        Flasher::addSuccess('Status diubah dalam perjalanan.');

        return redirect()->back();
    }

    public function selesaikanPengiriman($id)
    {
        $checkout = Checkout::find($id);

        if (!$checkout) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $checkout->status_pengiriman = 'selesai';
        $checkout->save();

        Flasher::addSuccess('Status diubah pengiriman selesai.');

        return redirect()->back();
    }
}
