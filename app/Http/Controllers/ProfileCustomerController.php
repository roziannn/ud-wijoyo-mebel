<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Province;
use App\Models\Regencie;

use Illuminate\Http\Request;
use function Flasher\Prime\flash;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Hash;

class ProfileCustomerController extends Controller
{
    function index()
    {
        $provinces = Province::all();
        $regencies = Regencie::all();

        $customerInfo = Customer::where('id_user', auth()->user()->id)->first();

        return view('customer.profile-index', compact('provinces', 'regencies', 'customerInfo'));
    }


    function updateProfile(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string|max:100',
            'provinsi' => 'required',
            'kota' => 'required',
            'kode_pos' => 'required',
        ]);


        try {

            $customer = \App\Models\Customer::where('id_user', auth()->id())->first();
            // dd($customer);

            if (!$customer) {
                $customer = new \App\Models\Customer();
                $customer->id_user = auth()->id();
            }

            $customer->nama_lengkap = $validatedData['nama_lengkap'];
            $customer->no_telp = $validatedData['no_telp'];
            $customer->alamat = $validatedData['alamat'];
            $customer->id_provinsi = $validatedData['provinsi'];
            $customer->id_kota = $validatedData['kota'];
            $customer->kode_pos = $validatedData['kode_pos'];
            $customer->save();

            Flasher::addSuccess('Profile berhasil diperbarui!');
            return redirect()->back();
        } catch (\Exception $e) {
            Flasher::addError('Terjadi kesalahan saat memperbarui profile.');
            return redirect()->back();
        }
    }

    function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            $user = auth()->user();

            $user->password = Hash::make($validatedData['password']);
            $user->save();

            Flasher::addSuccess('Password berhasil diperbarui!');
            return redirect()->back();
        } catch (\Exception $e) {
            Flasher::addError('Terjadi kesalahan saat memperbarui password.');
            return redirect()->back();
        }
    }
}
