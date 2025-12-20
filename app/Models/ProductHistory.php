<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    protected $fillable = ['product_id', 'user_id', 'quantity',
        'old_quantity', 'price', 'old_price', 'old_total_price', 'total_price',
        'action',
        'edited_by',
        'old_name',
        'new_name'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
