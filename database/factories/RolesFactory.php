<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Roles;
use Faker\Generator as Faker;

$factory->define(Roles::class, function (Faker $faker) {
    return [
        'name'=>$faker->unique()->name,
        'full_access'=>$faker->boolean,
        'description'=>$faker->text,
        'accessible_routes'=>[]
    ];
});
$factory->state(Roles::class,'SuperAdmin',function(Faker $faker){
    return [
        'name'=>'SuperAdmin',
        'full_access'=>true,
        'description'=>'Admin with full access',
    ];
});
$factory->state(Roles::class,'Manager',function(Faker $faker){
    return [
        'name'=>'Manager',
        'full_access'=>false,
        'description'=>'Manager with limited access',
    ];
});
