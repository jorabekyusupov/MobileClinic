<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AnalysisResult;
use Faker\Generator as Faker;

$factory->define(AnalysisResult::class, function (Faker $faker) {
    return [
        'organization_name' => $faker->company,
        'service_name' => $faker->word(),
        'registration_date' => $faker->date,
        'result_date' => $faker->date,
        'status' => $faker->numberBetween($min = 1, $max = 5 ),
        'user_id' => $faker->numberBetween($min =2, $max = 100)
    ];
});
