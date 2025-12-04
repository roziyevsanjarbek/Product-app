<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // User qo‘shgan productlar
    public function products()
    {
        return $this->hasMany(Product::class, 'created_by');
    }

    // User kiritgan sotuvlar
    public function sales()
    {
        return $this->hasMany(Sales::class, 'created_by');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

// role tekshirish
public function hasRole($roleName)
{
    return $this->roles()->where('name', $roleName)->exists();
}



}
