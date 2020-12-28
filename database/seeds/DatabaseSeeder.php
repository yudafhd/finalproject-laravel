<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Yuda',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('admin12345'),
            'level' => 'superadmin',
        ]);

        DB::table('users')->insert([
            'name' => 'Admin KNPI',
            'username' => 'adminknpi',
            'email' => 'admin_knpi@gmail.com',
            'password' => Hash::make('admin12345'),
            'level' => 'admin_knpi',
        ]);

        DB::table('roles')->insert([
            'name' => 'admin_knpi',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'admin_okp',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'menu settings',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'menu kegiatan',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'menu anggota',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'menu okp',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'menu user',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'menu user ganti level',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'menu roles',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'menu permissions',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'menu anggota buat anggota',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'menu kegiatan buat kegiatan',
            'guard_name' => 'web',
        ]);
    }
}
