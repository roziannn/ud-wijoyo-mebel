<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function index() //cart.blade.php as Index
    {
        $cartItem = Cart::where('id_user', auth()->user()->id)->get();

        $user = Auth::user();
        $customer = Customer::where('id_user', $user->id)->first();

        return view('customer.cart', compact('cartItem', 'customer'));
    }

    function addCart(Request $request)
    {

        $user = Auth::user();
        // dd($userId);

        if (!$user) {
            Flasher::addError('You need to log in to add items to the cart.');
            return redirect()->route('login');
        }

        $userId = $user->id;


        $request->validate([
            'id_produk' => 'required|exists:products,id',
            'nama' => 'required|max:100',
            'item_qty' => 'required|min:1',
            'item_harga' => 'required',
            'image' => 'required',
        ]);

        // dd($request->all());

        $existCartItem = Cart::where('id_user', $userId) //update Qty item tanpa create baris baru
            ->where('id_produk', $request->id_produk)
            ->first();

        if ($existCartItem) {
            $existCartItem->item_qty += $request->item_qty;
            $existCartItem->save();
        } else {
            Cart::create([
                'id_user' => $user->id,
                'id_produk' => $request->id_produk,
                'nama' => $request->nama,
                'item_qty' => $request->item_qty,
                'item_harga' => $request->item_harga,
                'image' => $request->image,
            ]);
        }


        Flasher::addSuccess('Item berhasil ditambahkan!');


        return redirect()->back();
    }

    function updateQty(Request $request)
    {

        $item = Cart::find($request->id);
        if ($item) {
            $item->item_qty = $request->qty;
            $item->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    function delete($id)
    {

        try {
            $item = Cart::findOrFail($id);
            $item->delete();
            Flasher::addSuccess('Item berhasil dihapus di keranjang!');
            return response()->json([
                'status' => 'success',
                'message' => 'Item berhasil dihapus.'
            ], 200);
        } catch (\Exception $e) {
            Flasher::addError('Item gagal dihapus!');
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus item.'
            ], 500);
        }
    }
}
