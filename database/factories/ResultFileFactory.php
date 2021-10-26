<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ResultFile;
use Faker\Generator as Faker;

$factory->define(ResultFile::class, function (Faker $faker) {
    return [
      'storagepath_name' => $faker->words($nb=4, $asText = true),
      'description' => $faker->text(),
      'result_id' => $faker->numberBetween($min = 1, $max = 100),
      'orginalname' => $faker->words($nb=4, $asText=true)
    ];
});
