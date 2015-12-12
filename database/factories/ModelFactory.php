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
        'company' => $faker->company,
        'name' => $faker->name,
        'roc_no' => $faker->word,
        'contact' => $faker->phoneNumber,
        'office_no' => $faker->phoneNumber,
        'address' => $faker->address,
        'postcode' => $faker->postcode,
        'email' => $faker->email,
        'remark' => $faker->text(20),
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'label' => $faker->name,
        'remark' => $faker->text(10),
    ];
});

$factory->define(App\Market::class, function (Faker\Generator $faker) {
    return [
        'company' => $faker->company,
        'name' => $faker->name,
        'contact' => $faker->phoneNumber,
        'email' => $faker->email,
        'subject' => $faker->text(8),
        'status' => 'Lead',
        'remark' => $faker->text(12),
    ];
});
