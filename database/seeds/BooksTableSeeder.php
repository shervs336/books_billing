<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 1; $i <= 20; $i++){
          DB::table('books')->insert([
            'author_name' => $faker->name(),
            'title' => $faker->sentence(floor(rand(1,6))),
            'published_by' => $faker->city,
            'published_date' => $faker->date(),
            'stocks' => floor(rand(1,10)),
            'price' => floor(rand(100,1000))
          ]);
        }

    }
}
