<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'quantity',
        'price',
        'created_by',
    ];

    // Productni kim qo‘shgan
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Product sotuvlari
    public function sales()
    {
        return $this->hasMany(Sales::class);
    }

    public function histories()
    {
        return $this->hasMany(ProductHistory::class);
    }

}
