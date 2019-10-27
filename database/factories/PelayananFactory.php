<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Pelayanan;
use App\Model;

$factory->define(Pelayanan::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle(),
        'price' => $faker->numerify('###000')
    ];
});
