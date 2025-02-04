<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Exports\TransaksiExport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    public function exportTransaksi()
    {
        try {
            return Excel::download(new TransaksiExport, 'laporan-transaksi.xlsx');
        } catch (\Exception $e) {
            Log::error('Export error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengekspor data: ' . $e->getMessage());
        }
    }
}
