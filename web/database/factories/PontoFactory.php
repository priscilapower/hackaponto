<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Ponto;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Ponto::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,3),
        'instituicao_id' => $faker->numberBetween(1,12),
        'expression' => $faker->numberBetween(0,6),
        'created_at' => $faker->dateTimeBetween('-1 years')
    ];
});
