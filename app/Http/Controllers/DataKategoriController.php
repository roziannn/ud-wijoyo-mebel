<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Redirect;

class DataKategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();

        return view('admin.data-kategori', compact('kategoris'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors()); // Dump semua error validasi
        }

        try {
            DB::table('kategoris')->insert([
                'nama' => $validatedData['nama'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Flasher::addSuccess('Kategori berhasil disimpan!');
            return Redirect::route('admin.data-kategori');
        } catch (\Exception $e) {
            Flasher::addError('Terjadi kesalahan saat menyimpan data produk.');
            return Redirect::route('admin.data-kategori');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
        ]);

        try {
            $kategori = Kategori::findOrFail($id);

            $kategori->update([
                'nama' => $request->input('nama'),
            ]);

            Flasher::addSuccess('Kategori berhasil disimpan!');
            return Redirect::route('admin.data-kategori');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Flasher::addError('Kategori tidak ditemukan!');
            return Redirect::back()->withInput();
        } catch (\Exception $e) {
            Flasher::addError('Terjadi kesalahan saat menyimpan kategori. Silakan coba lagi.');
            return Redirect::back()->withInput();
        }
    }

    function delete($id)
    {
        try {
            Kategori::findOrFail($id)->delete();
            Flasher::addSuccess('Kategori berhasil dihapus!');

            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something Went Wrong. Please Try Again!'], 500);
        }
    }
}
