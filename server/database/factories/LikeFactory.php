<?php

use App\Trek;
use App\User;
use App\Like;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        'trek_id' => function () {
            return factory(Trek::class)->create()->id;
        },
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
