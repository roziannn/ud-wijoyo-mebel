<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Product;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $produk = Product::all();

        return view('customer.index', compact('produk'));
    }

    function singleProduk($slug)
    {

        $storeProduct = Product::where('slug', $slug)->first();
        $items = Product::all();

        return view('guest.single-product', compact('storeProduct', 'items'));
    }

    function allProduk(Request $request)
    {
        $kategori = Kategori::all();
        $ruangan = Ruangan::all();

        // $storeProduct = Product::all();
        $storeProduct = Product::query();


        if ($request->has('category')) {
            $categoryName = $request->category;

            $category = Kategori::where('nama', $categoryName)->first();

            if ($category) {
                $storeProduct->where('kategori', $category->nama);
            }
        }

        $storeProduct = $storeProduct->get();

        return view('guest.all-product', compact('storeProduct', 'kategori', 'ruangan'));
    }
}
