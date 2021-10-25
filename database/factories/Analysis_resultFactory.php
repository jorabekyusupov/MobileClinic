<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Analysis_results;
use Faker\Generator as Faker;

$factory->define(Analysis_results::class, function (Faker $faker) {
    return [
        'org_name' => $faker->company,
        'service_name' => $faker->word(),
        'reg_date' => $faker->date,
        'result_date' => $faker->date,
        'status' => $faker->numberBetween($min = 1, $max = 5 ),
        'user_id' => $faker->numberBetween($min =2, $max = 100)
    ];
});
