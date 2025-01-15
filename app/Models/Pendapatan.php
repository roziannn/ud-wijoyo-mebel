<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    protected $fillable = ['id', 'id_checkout', 'total_pendapatan', 'tanggal_masuk'];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class, 'id_checkout');
    }
}
