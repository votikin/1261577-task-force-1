<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

use frontend\models\City;

$faker->addProvider(new Faker\Provider\ru_RU\Address($faker));
$faker->addProvider(new Faker\Provider\ru_RU\Person($faker));
$faker->addProvider(new Faker\Provider\ru_RU\Text($faker));
$faker->addProvider(new Faker\Provider\ru_RU\PhoneNumber($faker));
$countCity = City::find()->count();

return [
    'name' => $faker->name,
    'email' => $faker->email,
    'birthday' => $faker->date('Y-m-d'),
    'phone' => $faker->phoneNumber,
    'skype' => $faker->word(20),
    'about' => $faker->realText(),
    'password' => $faker->password,
    'address' => $faker->address,
    'created_at' => $faker->dateTimeBetween('-1 years','now')->format("Y-m-d H:i:s"),
    'view_count' => $faker->numberBetween(0,100),
    'is_hidden' => $faker->numberBetween(0,1),
    'city_id' => $faker->numberBetween(1,$countCity),
    'role_id' => $faker->numberBetween(1,2),
    'avatar' => $faker->imageUrl(),
    'last_activity' => $faker->dateTimeBetween('-1 month','now')->format("Y-m-d H:i:s"),
    'rating' => $faker->numberBetween(1,5),
    'has_review' => $faker->numberBetween(0,1),
];
