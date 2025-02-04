<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Customer;

use Illuminate\Http\Request;
use App\Models\CheckoutDetails;
use Illuminate\Support\Facades\DB;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    function index()
    {
        $user = Auth::user();
        $customer = Customer::where('id_user', $user->id)->first();

        return view('customer.checkout', compact('customer'));
    }

    public function store(Request $request)
    {

        dd($request->all());
        DB::beginTransaction();
        try {
            $user = Auth::user();

            $customer = Customer::where('id_user', $user->id)->first();

            $alamatCustomer = $customer->alamat . ", " .  $customer->regensi->name . ", PROVINSI " . $customer->provinsi->name;
            // dd($alamatCustomer);

            $kodeTransaksi = rand(100000, 999999);
            $request->validate([
                'id_cart' => 'required|string',
            ]);

            $idCartArray = explode(',', $request->id_cart);

            $carts = Cart::whereIn('id', $idCartArray)->get();

            $totalAmount = $carts->sum(function ($cart) {
                return $cart->item_qty * $cart->item_harga;
            });


            // store data checkout
            $checkout = Checkout::create([
                'id_user' => $customer->id_user,
                'kode_transaksi' => $kodeTransaksi,
                'total_amount' => $totalAmount,
                'payment_status' => 'pending',
                'status_pembayaran' => 'pending',
                'alamat_pengiriman' => $alamatCustomer,
                'status_pengiriman' => 'pending',
            ]);

            // Simpan detail checkout
            foreach ($carts as $cart) {
                CheckoutDetails::create([
                    'id_checkout' => $checkout->id,
                    'id_produk' => $cart->id_produk,
                    'kode_transaksi' => $kodeTransaksi,
                    'qty' => $cart->item_qty,
                    'harga' => $cart->item_harga,
                    'total_harga' => $cart->item_qty * $cart->item_harga,
                ]);

                // Update stok produk
                $cart->produk->decrement('stock', $cart->item_qty);
            }

            Cart::whereIn('id', $idCartArray)->delete();

            DB::commit();
            Flasher::addSuccess('Checkout produk berhasil!');
            return redirect()->route('customer.transaksi');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error('Error during checkout: ' . $e->getMessage());
            Flasher::addError('Error checkout.' . $e->getMessage());
            return redirect()->back();
        }
    }
}
