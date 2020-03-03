<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

use frontend\models\Category;
use frontend\models\City;
use frontend\models\TaskStatus;
use frontend\models\User;

$faker->addProvider(new Faker\Provider\ru_RU\Text($faker));
$categoryCount = Category::find()->count();
$cityCount = City::find()->count();
$userCount = User::find()->count();
$status = TaskStatus::findOne([TaskStatus::tableName().".name" => TaskStatus::NAME_STATUS_NEW]);

return [
    'short' => $faker->realText(30),
    'description' => $faker->realText(100),
    'budget' => $faker->numberBetween(500,5000),
    'deadline' => $faker->dateTimeBetween('now','+1 years')->format("Y-m-d H:i:s"),
    'category_id' => $faker->numberBetween(1,$categoryCount),
    'city_id' => $faker->numberBetween(1,$cityCount),
    'user_id' => $faker->numberBetween(1,$userCount),
    'status_id' => $status->id,
    'created_at' => $faker->dateTimeBetween('-1 years','now')->format("Y-m-d H:i:s"),
];
