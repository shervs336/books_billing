<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

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
          'firstname' => 'Admin',
          'lastname' => 'Admin',
          'username' => 'admin',
          'password' => bcrypt('password'),
          'created_at' => new DateTime
        ]);
    }
}
