<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Photo;
use App\Gallery;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'img' => 'img/landscape1.jpg',
        'taken_at' => Carbon::parse($faker->dateTime),
        'featured' => $faker->boolean,
        'gallery_id' => Gallery::first()->id,
    ];
});
