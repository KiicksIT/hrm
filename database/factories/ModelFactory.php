<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->name,
        'email' => $faker->email,
        'contact' => $faker->phoneNumber,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Person::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'nric_fin' => $faker->randomNumber,
        'contract_type' => 'Fulltime',
        'gender' => 'Male',
        'dob' => $faker->dateTime(),
        'nationality' => 'Singaporean',
        'resident' => 'True',
        'contact' => $faker->phoneNumber,
        'address' => $faker->address,
        'email' => $faker->email,
        'start_date' => $faker->dateTime(),
        'person_remark' => $faker->text(20),
        'basic' => 2000,
        'basic_hour' => 8,
        'ot_rate' => 1.5,
        'department_id' => 1,
        'position_id' => 1,
    ];
});

$factory->define(App\Position::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'label' => $faker->name,
        'remark' => $faker->text(10),
    ];
});

$factory->define(App\MainIndex::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6),
        'content' => $faker->paragraph,
    ];
});

