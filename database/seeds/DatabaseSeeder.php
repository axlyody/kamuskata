<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
            ->insert([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'created_at' => Carbon::now()
            ]);

        DB::table('users')
            ->insert([
                'name' => 'user',
                'email' => 'user@user.com',
                'password' => Hash::make('user'),
                'role' => 'user',
                'created_at' => Carbon::now()
            ]);
    }
}
