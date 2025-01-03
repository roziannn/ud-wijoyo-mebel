<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'nama_lengkap', 'no_telp', 'alamat', 'id_provinsi', 'id_kota', 'kode_pos'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function regensi()
    {
        return $this->belongsTo(Regencie::class, 'id_kota', 'id');
    }

    public function provinsi()
    {
        return $this->belongsTo(Province::class, 'id_provinsi', 'id');
    }
}
