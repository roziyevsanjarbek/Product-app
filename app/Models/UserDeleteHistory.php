<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDeleteHistory extends Model
{

    protected $table = 'user_deletes_history';

    protected $fillable = ['before', 'admin_id'];

    protected $casts = [
        'before' => 'array',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
