<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

use App\Helpers\GeneratorHelper;

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

$factory->define(App\Models\Users\User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName.' '. $faker->lastName ,
        'email' => $faker->unique()->safeEmail,
        'user_classification_id' => 1,
        'position' => 'purchasing officer',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
