<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use softDeletes;

    protected $table = 'sales';

    protected $fillable = [
        'product_id',
        'quantity',
        'total_price',
        'deleted_by',
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

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
