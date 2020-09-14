<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Trek;
use App\User;

$factory->define(Trek::class, function (Faker $faker) {
    return [
        'name' => $faker->text(10),
        'difficulty' => $faker->text(10),
        'address' => $faker->address(20),
        'area' => $faker->text(5),
        'days' => $faker->text(5),
        'comment' => $faker->text(50),
        'image_url' => $faker->text(30),
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
