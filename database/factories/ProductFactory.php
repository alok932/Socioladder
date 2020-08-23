<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2), 
        'price' => $faker->randomNumber(4), 
        'discount_percent' => $faker->numberBetween(1, 100), 
        'description' => $faker->paragraph, 
        //'display_image' => $faker->imageUrl(200, 200)
        'display_image' => $faker->image('public/uploads/products', 200, 200, 'cats', false),
    ];
});
