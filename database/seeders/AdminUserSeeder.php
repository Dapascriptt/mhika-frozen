<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'name' => 'Admin Mhika',
            'email' => 'mhikafrozen@gmail.com',
            'password' => Hash::make('pemuda123'),
            'is_admin' => true,
            'updated_at' => now(),
        ];

        if (Schema::hasColumn('users', 'no_telp')) {
            $data['no_telp'] = '081234567890';
        }

        if (Schema::hasColumn('users', 'role')) {
            $data['role'] = 'admin';
        }

        $existingUser = User::where('email', 'mhikafrozen@gmail.com')->first();

        if ($existingUser) {
            DB::table('users')->where('id', $existingUser->id)->update($data);
            return;
        }

        $data['created_at'] = now();

        DB::table('users')->insert($data);
    }
}
