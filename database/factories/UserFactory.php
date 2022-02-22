<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Helper\Helper;

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

// $factory->define(User::class, function (Faker $faker) {
//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'email_verified_at' => now(),
//         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//         'remember_token' => Str::random(10),
//     ];
// });

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'ADMIN',
        'email' => 'admin@techware.com.np',
        'phone' => '9852012345',
        'address' => 'Biratnagar',
        'email_verified_at' => now(),
        'password' => '$2y$10$eAEF24Uto64jknFqlzRgXOZA7tWIiWNo3NB3dSpgkzQseTHOL7aIK', //admin123
        // 'date_np' => $this->helper->date_np_con_parm(date('Y-m-d')),
        'date_np' => date('Y-m-d'),
        'date' => date('Y-m-d'),
        'time' => date('H:i:s'),
        'user_type' => '1',
        'is_active' => '1',
        'created_at' => date('Y-m-d H:i:s'),
    ];
});
