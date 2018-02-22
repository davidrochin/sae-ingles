<?php

use Faker\Generator as Faker;
use Faker\Factory as Factory;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Student::class, function (Faker $faker) {

$faker = Factory::create('es_ES');

	return [
		'control_number' => $faker->ean8,
		'career' => $faker->words(3, true),
		'first_names' => $faker->firstName,
		'fathers_last_name' => $faker->lastName,
		'mothers_last_name' => $faker->lastName,
		'phone_number' => $faker->phoneNumber,
		'email' => $faker->email
	];

});