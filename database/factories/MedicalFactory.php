<?php

use Faker\Generator as Faker;

$factory->define(\App\Medical::class, function (Faker $faker) {
    $types = ['pharmacy', 'hospital'];
    $isHoly = rand(0, 1);
    $isWeekend = rand(0, 1);

    return [
        'type' => $types[rand(0, 1)],
        'name' => $faker->company,
        'tel' => "$faker->phoneNumber",
        'hpid' => "$faker->unixTime",
        'etc' => $faker->realText(150),
        'addr' => $faker->address,
        'postcode' => $faker->postcode,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'weekday_s' => '0900',
        'saturday_s' => $isWeekend ? '0900' : null,
        'sunday_s' => $isWeekend ? '0900' : null,
        'holiday_s' => $isHoly ? '0900' : null,
        'weekday_e' => '1800',
        'saturday_e' => $isWeekend ? '1600' : null,
        'sunday_e' => $isWeekend ? '1600' : null,
        'holiday_e' => $isHoly ? '1600' : null,
    ];
});