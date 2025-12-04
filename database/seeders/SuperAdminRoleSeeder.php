<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SuperAdminRoleSeeder extends Seeder
{
    public function run()
    {
        // Roles jadvalida 'superAdmin' mavjudligini tekshirish, yo'q bo'lsa yaratish
        $roleId = DB::table('roles')->where('name', 'superAdmin')->value('id');
        if (!$roleId) {
            $roleId = DB::table('roles')->insertGetId([
                'name' => 'superAdmin',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Super Admin userni topish
        $user = User::where('email', 'superadmin@example.com')->first();

        if ($user) {
            // eski rolni o'chirish
            DB::table('role_user')->where('user_id', $user->id)->delete();

            // superAdmin rolini bog‘lash
            DB::table('role_user')->insert([
                'user_id' => $user->id,
                'role_id' => $roleId
            ]);

            echo "User '{$user->name}' role 'superAdmin' ga o'zgartirildi.\n";
        } else {
            echo "Super Admin user topilmadi.\n";
        }
    }
}
