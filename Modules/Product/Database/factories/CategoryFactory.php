<?php

declare(strict_types = 1);

use Faker\Generator as Faker;
use Modules\Product\Entities\Category;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Category::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'slug' => $faker->unique()->slug(1),
    ];
});

$factory->state(Category::class, 'all', function (Faker $faker) {
    return [
        'title' => 'All',
        'slug' => 'all',
    ];
});

$factory->state(Category::class, 'newest', function (Faker $faker) {
    return [
        'title' => 'Newest',
        'slug' => 'newest',
    ];
});

$factory->state(Category::class, 'most_seen', function (Faker $faker) {
    return [
        'title' => 'Most seen',
        'slug' => 'most-seen',
    ];
});