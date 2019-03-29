<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'liwei@gmail.com',
            'password' => bcrypt('WyX`,Z=[6$6nnZ+Z'),
        ]);
    }
}
