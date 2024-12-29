<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Redirect;

class DataRuanganController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();

        return view('admin.data-ruangan', compact('ruangan'));
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
            DB::table('ruangans')->insert([
                'nama' => $validatedData['nama'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Flasher::addSuccess('Ruangan berhasil disimpan!');
            return Redirect::route('admin.data-ruangan');
        } catch (\Exception $e) {
            Flasher::addError('Terjadi kesalahan saat menyimpan data ruangan.');
            return Redirect::route('admin.data-ruangan');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
        ]);

        try {
            $ruangan = Ruangan::findOrFail($id);

            $ruangan->update([
                'nama' => $request->input('nama'),
            ]);

            Flasher::addSuccess('Ruangan berhasil disimpan!');
            return Redirect::back();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Flasher::addError('Ruangan tidak ditemukan!');
            return Redirect::back()->withInput();
        } catch (\Exception $e) {
            Flasher::addError('Terjadi kesalahan saat menyimpan ruangan. Silakan coba lagi.');
            return Redirect::back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
