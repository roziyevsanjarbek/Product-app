<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'product_id',
        'quantity',
        'total_price',
        'created_by',
    ];

    // Qaysi product sotilgan
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Sotuvni kim kiritgan
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
