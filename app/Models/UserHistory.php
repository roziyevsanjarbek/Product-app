<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'edited_by',
        'old_name',
        'new_name',
        'old_email',
        'new_email',
        'old_password',
        'new_password',

        'old_role',
        'new_role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }

}
