<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

use frontend\models\City;
use frontend\models\Role;
use common\fixtures\CityFixture;

$faker->addProvider(new Faker\Provider\ru_RU\Address($faker));
$faker->addProvider(new Faker\Provider\ru_RU\Person($faker));
$faker->addProvider(new Faker\Provider\ru_RU\Text($faker));
$faker->addProvider(new Faker\Provider\ru_RU\PhoneNumber($faker));
$countCity = City::find()->count();
$role = Role::findOne([Role::tableName().".name" => Role::EXECUTOR_ROLE]);

return [
    'name' => $faker->name,
    'email' => $faker->email,
    'about' => $faker->realText(),
    'password' => $faker->password,
    'rating' => $faker->numberBetween(1,5),
    'phone' => $faker->phoneNumber,
    'role_id' => $role->id,
    'city_id' => $faker->numberBetween(1,$countCity),
    'has_review' => $faker->numberBetween(0,1),
];
