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
            'name' => 'Alifa',
            'username' => 'superadmin',
            'email' => 'alifa@gmail.com',
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
    }
}