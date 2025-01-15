<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaOperasional;
use App\Models\KategoriOperasional;
use Flasher\Laravel\Facade\Flasher;

class KelolaOperasionalController extends Controller
{

    public function index()
    {
        $data = KelolaOperasional::with('kategoriOperasional')->get();
        $kategori_operasional = KategoriOperasional::all();

        return view('admin.kelola-operasional', compact('data', 'kategori_operasional'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pengeluaran' => 'required|date',
            'id_kategori_operasional' => 'required|exists:kategori_operasionals,id',
            'biaya' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        KelolaOperasional::create($request->all());

        Flasher::addSuccess('Data berhasil dibuat!');


        return redirect()->route('admin.kelola-operasional');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_pengeluaran' => 'required|date',
            'id_kategori_operasional' => 'required|exists:kategori_operasionals,id',
            'biaya' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        $pengeluaran = KelolaOperasional::findOrFail($id);
        $pengeluaran->update($request->all());

        Flasher::addSuccess('Data berhasil disimpan!');

        return redirect()->route('admin.kelola-operasional');
    }
}
