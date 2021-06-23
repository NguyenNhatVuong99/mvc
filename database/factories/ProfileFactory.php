<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Models\Profile::class, function (Faker $faker) {
    return [
        'user_id' => User::factory(),
        'phone'=>$faker->phoneNumber,
        'province_id' => $province,
        'district_id' => App\Models\District::where('province_id', $province)->inRandomOrder()->value('id'),
        'district_id' => App\Models\District::where('district_id', $district)->inRandomOrder()->value('id'),
        'address'=>str_random(20),

    ];
});
