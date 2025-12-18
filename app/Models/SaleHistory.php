<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleHistory extends Model
{
    protected $table = 'sale_histories';

    protected $fillable = [
        'sale_id',
        'user_id',
        'product_id',
        'edited_by',
        'quantity',
        'total_price',
        'action',
        'price',
        'old_price',
        'old_total_price',
        'old_quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sales::class);
    }
}
