<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Website::class, function (Faker $faker) {
    return [
        'contact_id' => function () {
            return factory(App\Models\Contact::class)->create()->id;
        },
        'asset_id' => function () {
            return factory(App\Models\Asset::class)->create()->id;
        },
        'url' => $faker->url,
        'website_type' => $faker->randomElement(config('polanco.website_types')),
        'description' => $faker->sentence,
    ];
});
