<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'id_user', 'id_produk', 'nama', 'item_qty', 'item_harga', 'image'];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id');
    }
}
