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
            'password' => Hash::make('pinterlink739155'),
            'access_type' => 'superadmin',
        ]);

        DB::table('roles')->insert([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
    }
}