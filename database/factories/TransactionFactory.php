<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Transactions::class, function (Faker $faker) {
    return [
        'amount' => rand(100,20000),
		'description' => $faker->text,
    ];
});
