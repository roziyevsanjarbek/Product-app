<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        // 1️⃣ Roles jadvalida 'admin' mavjudligini tekshiramiz, yo'q bo'lsa qo'shamiz
        $roleId = DB::table('roles')->where('name', 'admin')->value('id');
        if (!$roleId) {
            $roleId = DB::table('roles')->insertGetId([
                'name' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // 2️⃣ Super Admin user yaratish
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'), // xavfsiz parolni keyin o‘zgartir
        ]);

        // 3️⃣ role_user pivot jadvalga qo'shish
        DB::table('role_user')->insert([
            'user_id' => $user->id,
            'role_id' => $roleId
        ]);
    }
}
