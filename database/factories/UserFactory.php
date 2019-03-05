<?php

use App\Career;
use App\User;
use App\Role;
use App\Period;
use App\Classroom;
use App\ToeflGroup;
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

	$faker = Factory::create('es_ES');

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secreto'), // secreto
        //'remember_token' => str_random(10),
        'role_id' => Role::where('name', 'professor')->first()->id,
    ];
});

$factory->define(App\Student::class, function (Faker $faker) {

	$faker = Factory::create('es_ES');

	return [
		'control_number' => $faker->numberBetween(14000000, 20000000),
		'career_id' => $faker->boolean(95) ? Career::inRandomOrder()->get()[0]->id : NULL,
		'first_names' => $faker->firstName,
		'last_names' => $faker->lastName.' '.$faker->lastName,
		'phone_number' => $faker->boolean(95) ? $faker->ean8 : NULL,
		'email' => $faker->boolean(95) ? $faker->email : NULL,
	];

});

$factory->define(App\Group::class, function (Faker $faker) {

	$faker = Factory::create('es_ES');
	$professorRoleId = Role::where('name', 'professor')->first()->id;

	$scheduleStartHour = $faker->numberBetween(7,22);
	$scheduleStart = $scheduleStartHour.':00:00';
	$scheduleEnd = ($scheduleStartHour + 1).':00:00'; 

	return [
		'level' => $faker->numberBetween(1, 5),
		'schedule_start' => $scheduleStart,
		'schedule_end' => $scheduleEnd,
		'days' => $faker->randomElement([12345, 6, 135, 24]),
		'code' => $faker->numberBetween(1000, 9999),
		'name' => $faker->randomElement(['A', 'B']),
		'user_id' => $faker->boolean(95) ? User::inRandomOrder()->whereNotIn('id', [1,2])->first()->id : NULL,
		'active' => $faker->numberBetween(0, 1),
		'period_id' => Period::inRandomOrder()->first()->id,
		'year' => $faker->numberBetween(2000, 2018),
		'classroom_id' => $faker->boolean(90) ? Classroom::inRandomOrder()->first()->id : NULL,
		'capacity' => $faker->randomElement([35, 40, 45]),
	];

});

$factory->define(App\ToeflGroup::class, function (Faker $faker) {

	$faker = Factory::create('es_ES');

	return [
		'date' => $faker->date(),
		'responsable_user_id' => $faker->boolean(95) ? User::inRandomOrder()->whereNotIn('id', [1,2])->first()->id : NULL,
		'applicator_user_id' => $faker->boolean(95) ? User::inRandomOrder()->whereNotIn('id', [1,2])->first()->id : NULL,
	];

});

