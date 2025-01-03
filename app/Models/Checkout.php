<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(CheckoutDetails::class, 'id_checkout');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_user', 'id_user');
    }
}
