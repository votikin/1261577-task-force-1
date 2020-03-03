<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

use frontend\models\Category;
use frontend\models\User;

$userCount = User::find()->count();
$categoryCount = Category::find()->count();

return [
    'user_id' => $faker->numberBetween(1,$userCount),
    'category_id' => $faker->numberBetween(1,$categoryCount),
];
