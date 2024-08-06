<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $arkandevhengkerUser = DB::table('users')->insertGetId([
            'nidn' => '01110111',
            'nama' => 'arkandevhengker',
            'email' => 'arkandevhengker@example.com',
            'nip' => 'test-nip-1000',
            'no_telepon' => '081234567890',
            'jabatan_fungsional' => 'rektor',
            'rumpun' => 'Management',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $adamdevelopmentUser = DB::table('users')->insertGetId([
            'nidn' => '102021',
            'nama' => 'adamdevelopment',
            'email' => 'adamdevelopment@example.com',
            'nip' => 'test-nip-2000',
            'no_telepon' => '081234567891',
            'jabatan_fungsional' => 'guru_besar',
            'rumpun' => 'Science',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Assign roles to users
        DB::table('role_user')->insert([
            ['user_id' => '01110111', 'role_id' => 1], // Admin role
            ['user_id' => '102021', 'role_id' => 2],  // Guru role
        ]);
    }
}
