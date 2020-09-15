<?php

use App\Trek;
use App\User;
use App\Comment;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'trek_id' => function () {
            return factory(Trek::class)->create()->id;
        },
        'comment' => $faker->text(50),
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
