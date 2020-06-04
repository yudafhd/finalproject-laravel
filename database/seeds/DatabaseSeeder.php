<?php

use Illuminate\Database\Seeder;

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
            'name' => 'superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('Rpkbulog'),
            'access_type' => 'superadmin',
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Rpkbulog'),
            'access_type' => 'admin',
        ]);

        DB::table('roles')->insert([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
        DB::table('roles')->insert([
            'name' => 'rpk',
            'guard_name' => 'web',
        ]);
        DB::table('roles')->insert([
            'name' => 'umum',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'rpk',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'items',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'pemesanan',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'penerimaan',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'settings',
            'guard_name' => 'web',
        ]);
    }
}