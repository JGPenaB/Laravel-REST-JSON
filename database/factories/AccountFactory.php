<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Accounts::class, function (Faker $faker) {
	switch (rand(1,2)) {
        case 1:
            $type='current';
            break;
        default:
            $type='deposit';
        break;
    }
	
    return [
        'account_type' => $type,
		'balance' => rand(500,50000),
		'is_active' => rand(0,1),
    ];
});
