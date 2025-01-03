<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;

class DataTransaksiController extends Controller
{
    function index()
    {
        $transaksi = Checkout::all();

        return view('admin.data-transaksi', compact('transaksi'));
    }

    function show($kode)
    {

        $transaksi = Checkout::with('details.product')
            ->where('kode_transaksi', $kode)
            ->first();

        // dd($transaksi);

        if (!$transaksi) {
            return redirect()->route('admin.transaksi-customer')->with('error', 'Transaksi tidak ditemukan.');
        }

        return view('admin.data-transaksi-show', compact('transaksi'));
    }

    public function approve($id)
    {
        try {
            $transaksi = Checkout::findOrFail($id);
            $transaksi->update([
                'status_pembayaran' => 'disetujui',
                'status_pengiriman' => 'perlu_dikirim',
            ]);

            Flasher::addSuccess('Pembayaran berhasil disetujui!');
            return redirect()->route('admin.transaksi-customer');
        } catch (\Exception $e) {
            Flasher::addError('Terjadi kesalahan saat menyetujui pembayaran.');
            return redirect()->back();
        }
    }
}
