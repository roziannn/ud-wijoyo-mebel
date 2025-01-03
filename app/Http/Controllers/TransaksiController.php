<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Customer;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;

class TransaksiController extends Controller
{
    function index()
    {
        $user = auth()->user();

        $customer = Customer::where('id_user', $user->id)->first();

        if (!$customer) {
            return redirect()->route('customer.profile')->with('error', 'Silakan lengkapi profil Anda terlebih dahulu.');
        }

        $transaksi = Checkout::where('id_user', $customer->id_user)->get();

        return view('customer.transaksi', compact('transaksi'));
    }

    function show($id)
    {

        $transaksi = Checkout::with('details.product')
            ->where('id', $id)
            ->where('id_user', auth()->user()->id)
            ->first();

        if (!$transaksi) {
            return redirect()->route('customer.transaksi')->with('error', 'Transaksi tidak ditemukan.');
        }

        // deadline pembayaran
        $deadline = $transaksi->created_at->addDays(2);
        $currentDate = now();
        $isPending = $transaksi->payment_status === 'pending';

        return view('customer.transaksi-show', compact('transaksi',  'deadline', 'currentDate', 'isPending'));
    }

    function store(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar_img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $transaksi = Checkout::findOrFail($id);

        // dd($transaksi);

        if ($request->hasFile('bukti_bayar_img')) {
            $path = $request->file('bukti_bayar_img')->store('bukti_bayar', 'public');

            $transaksi->update([
                'bukti_bayar_img' => $path,
                'tanggal_pembayaran' => now(),
                'payment_status' => 'selesai'
            ]);
        }

        Flasher::addSuccess('Pesanan berhasil dibayar! menuggu konfirmasi admin');
        return redirect()->route('customer.transaksi');
    }
}
