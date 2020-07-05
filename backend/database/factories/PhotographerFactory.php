<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Photographer;
use Faker\Generator as Faker;

$factory->define(Photographer::class, function (Faker $faker) {
    return [
        'name' => 'Nick Reynolds',
        'phone' => '555-555-5555',
        'email' => 'nick.reynolds@domain.co',
        'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
        'profile_picture' => 'img/profile.jpg',
    ];
});
