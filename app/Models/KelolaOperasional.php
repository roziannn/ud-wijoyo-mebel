<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelolaOperasional extends Model
{
    protected $fillable = ['id', 'id_kategori_operasional', 'biaya', 'deskripsi', 'tanggal_pengeluaran'];

    public function kategoriOperasional()
    {
        return $this->belongsTo(KategoriOperasional::class, 'id_kategori_operasional', 'id');
    }
}
