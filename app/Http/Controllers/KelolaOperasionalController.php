<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaOperasional;
use App\Models\KategoriOperasional;

class KelolaOperasionalController extends Controller
{

    public function index()
    {
        $data = KelolaOperasional::with('kategoriOperasional')->get();
        $kategori_operasional = KategoriOperasional::all();

        return view('admin.kelola-operasional', compact('data', 'kategori_operasional'));
    }
}
