<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Profiles::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstname,
		'last_name' => $faker->lastname,
		'address' => $faker->address,
		'country' => $faker->country,
		'phone_number' => $faker->phonenumber,
		'zip_code' => $faker->postcode,
    ];
});
