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
            'password' => Hash::make('adminadmin'),
            'type' => 'superadmin',
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminadmin'),
            'type' => 'admin',
        ]);

        DB::table('roles')->insert([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'guru',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'siswa',
            'guard_name' => 'web',
        ]);
    }
}