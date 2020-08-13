<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DonationType::class, function (Faker $faker) {
    $label = $faker->word;
    $value = $faker->numberBetween(1000,2000);
    return [
        'label' => $label,
        'value' => $value,
        'name' => $label,
        'description' => $label.' ('.$value.')',
        'is_default' => $faker->boolean,
        'is_reserved' => $faker->boolean,
        'is_active' => $faker->boolean,
        'remember_token' => Str::random(10),
    ];
});
