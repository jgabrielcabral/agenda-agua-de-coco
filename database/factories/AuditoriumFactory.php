<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Auditorium;
use Faker\Generator as Faker;

$factory->define(Auditorium::class, function (Faker $faker) {
    return [
        'name' => 'Auditório '.$faker->unique()->city,
    ];
});
