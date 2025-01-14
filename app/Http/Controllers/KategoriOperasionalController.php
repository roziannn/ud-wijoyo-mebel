<?php

namespace App\Http\Controllers;

use App\Models\KategoriOperasional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Redirect;

class KategoriOperasionalController extends Controller
{
    function kategoriShow()
    {

        $datas = KategoriOperasional::all();

        return view('admin.kategori-operasional', compact('datas'));
    }

    public function kategoriStore(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }

        try {
            DB::table('kategori_operasionals')->insert([
                'nama' => $validatedData['nama'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Flasher::addSuccess('Kategori operasional berhasil disimpan!');
            return Redirect::route('admin.kategori-operasional');
        } catch (\Exception $e) {
            Flasher::addError('Terjadi kesalahan saat menyimpan data kategori.');
            return Redirect::route('admin.kategori-operasional');
        }
    }

    public function kategoriUpdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
        ]);

        try {
            $kategori = KategoriOperasional::findOrFail($id);

            $kategori->update([
                'nama' => $request->input('nama'),
            ]);

            Flasher::addSuccess('Kategori berhasil disimpan!');
            return Redirect::back();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Flasher::addError('Kategori tidak ditemukan!');
            return Redirect::back()->withInput();
        } catch (\Exception $e) {
            Flasher::addError('Terjadi kesalahan saat menyimpan kategori. Silakan coba lagi.');
            return Redirect::back()->withInput();
        }
    }

    function kategoriDelete($id)
    {
        try {
            KategoriOperasional::findOrFail($id)->delete();
            Flasher::addSuccess('Kategori operasional berhasil dihapus!');

            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something Went Wrong. Please Try Again!'], 500);
        }
    }
}
