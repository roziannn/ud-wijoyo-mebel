<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckoutDetails extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}
