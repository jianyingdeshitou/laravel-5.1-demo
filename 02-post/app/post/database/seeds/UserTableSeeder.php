<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Post\User::truncate();
        Post\User::create([
            'email' => 'foo@bar.com',
            'name' => 'admin',
            'password' => bcrypt('admin')
        ]);
    }
}
