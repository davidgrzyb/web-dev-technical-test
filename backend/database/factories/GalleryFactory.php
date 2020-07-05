<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Gallery;
use App\Photographer;
use Faker\Generator as Faker;

$factory->define(Gallery::class, function (Faker $faker) {
    return [
        'photographer_id' => Photographer::first()->id,
    ];
});
