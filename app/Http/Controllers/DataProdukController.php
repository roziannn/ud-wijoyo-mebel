<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Product;
use App\Models\Ruangan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class DataProdukController extends Controller
{
    function index()
    {
        $products = Product::all();

        return view('admin.data-produk', compact('products'));
    }

    function create()
    {
        $kategori = Kategori::all();
        $ruangan = Ruangan::all();

        return view('admin.data-produk-create', compact('kategori', 'ruangan'));
    }

    function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'nama' => 'required',
                'stock' => 'required|integer|min:1',
                'kategori' => 'required|string|max:100',
                'jenis_ruangan' => 'required|string|max:100',
                'deskripsi' => 'required|string',
                'harga' => 'required',
                'status' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors()); // Dump semua error validasi
        }

        // dd($request->all());

        try {
            $imagePath = $request->file('image')->store('products', 'public');

            $slug = Str::slug($validatedData['nama'], '-');

            $originalSlug = $slug;
            // dd($originalSlug)
            $counter = 1;
            while (DB::table('products')->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            // dd($imagePath);

            DB::table('products')->insert([
                'image' => $imagePath,
                'nama' => $validatedData['nama'],
                'slug' => $slug,
                'stock' => $validatedData['stock'],
                'kategori' => $validatedData['kategori'],
                'jenis_ruangan' => $validatedData['jenis_ruangan'],
                'deskripsi' => $validatedData['deskripsi'],
                'harga' => $validatedData['harga'],
                'status' => $validatedData['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Flasher::addSuccess('Produk berhasil disimpan!');
            return Redirect::route('admin.data-produk');
        } catch (\Exception $e) {
            Flasher::addError('Terjadi kesalahan saat menyimpan data produk.');
            return Redirect::route('admin.data-produk');
        }
    }

    function edit($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $kategori = Kategori::all();
        $ruangan = Ruangan::all();

        return view('admin.data-produk-edit', compact('product', 'kategori', 'ruangan'));
    }

    function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'nama' => 'required',
                'stock' => 'required|integer|min:1',
                'kategori' => 'required|string|max:100',
                'jenis_ruangan' => 'required|string|max:100',
                'deskripsi' => 'required|string',
                'harga' => 'required',
                'status' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }

        // dd($request->all());

        try {
            $product = DB::table('products')->where('id', $id)->first();

            if (!$product) {
                Flasher::addError('Produk tidak ditemukan.');
                return redirect()->back();
            }

            $imagePath = $product->image;

            if ($request->hasFile('image')) {
                if ($product->image && Storage::exists('public/' . $product->image)) {
                    Storage::delete('public/' . $product->image);
                }

                $imagePath = $request->file('image')->store('products', 'public');
            }

            $slug = Str::slug($validatedData['nama'], '-');
            $originalSlug = $slug;

            $counter = 1;
            while (DB::table('products')->where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            DB::table('products')->where('id', $id)->update([
                'image' => $imagePath,
                'nama' => $validatedData['nama'],
                'slug' => $slug,
                'stock' => $validatedData['stock'],
                'kategori' => $validatedData['kategori'],
                'jenis_ruangan' => $validatedData['jenis_ruangan'],
                'deskripsi' => $validatedData['deskripsi'],
                'harga' => $validatedData['harga'],
                'status' => $validatedData['status'],
                'updated_at' => now(),
            ]);

            Flasher::addSuccess('Produk berhasil diperbarui!');
            return Redirect::route('admin.data-produk');
        } catch (\Exception $e) {
            Flasher::addError('Terjadi kesalahan saat memperbarui data produk.');
            return redirect()->back();
        }
    }

    function delete($id)
    {
        try {
            Product::findOrFail($id)->delete();
            Flasher::addSuccess('Produk berhasil dihapus!');

            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something Went Wrong. Please Try Again!'], 500);
        }
    }
}
