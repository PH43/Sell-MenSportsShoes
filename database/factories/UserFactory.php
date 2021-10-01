<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Users;
use App\Roles;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Users::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => '0932023992',
        'password' => '4297f44b13955235245b2497399d7a93',
        'flag'=>1,
        'remember_token' => Str::random(10),
    ];
});
    $factory->afterCreating(Users::class, function($users,$faker){
    $role = Roles::where('roles_name','admin')->get();
    $users->roles()->sync($role->pluck('id'));
});