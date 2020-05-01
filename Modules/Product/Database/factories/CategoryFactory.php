<?php
declare(strict_types=1);
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\Product\Entities\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'title'=>$faker->title,
        'slug'=>$faker->unique()->slug(1),
        'active'=>$faker->boolean
    ];
});
$factory->state(Category::class,'all',function(Faker $faker){
    return [
        'title'=>'All',
        'slug'=>'all'
    ];
});
$factory->state(Category::class,'newest',function(Faker $faker){
    return [
        'title'=>'Newest',
        'slug'=>'newest'
    ];
});
$factory->state(Category::class,'popular',function(Faker $faker){
    return [
        'title'=>'Popular',
        'slug'=>'popular'
    ];
});
