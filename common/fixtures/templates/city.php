<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$faker->addProvider(new Faker\Provider\ru_RU\Address($faker));

return [
    'name' => $faker->city,
    'latitude' => $faker->latitude,
    'longitude' => $faker->longitude,
];
