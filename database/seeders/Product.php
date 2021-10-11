<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        \App\Models\Type::factory()->count(3)->create();
        \App\Models\Color::factory()->count(3)->create();


        for ($i = 0; $i < 20; $i++) {
            $product_t = \App\Models\Type::findOrFail($faker->randomElement([1, 2, 3]));
            $create = new \App\Models\Product();
            $create->name = $faker->sentence;
            $create->type_id = $product_t->id;
            $create->price = rand(50, 200);
            $create->additional_price = rand(10, 50);
            $create->save();

            $create->productColors()->attach(['color_id' => Color::all()->random()->id]);
            $create->save();
        }

    }

}
