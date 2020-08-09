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
            'email' => 'superadmin@pinter.link',
            'password' => Hash::make('pinterlink739155'),
            'access_type' => 'superadmin',
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@pinter.link',
            'password' => Hash::make('pinterlink739155'),
            'access_type' => 'admin',
        ]);

        DB::table('roles')->insert([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
    }
}