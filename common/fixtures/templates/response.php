<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

use frontend\models\User;
use frontend\models\Task;

$faker->addProvider(new Faker\Provider\ru_RU\Text($faker));
$countUser = User::find()->count();
$countTask = Task::find()->count();


return [
    'comment' => $faker->realText(40),
    'price' => $faker->numberBetween(1,5000),
    'user_id' => $faker->numberBetween(1,$countUser),
    'task_id' => $faker->numberBetween(1,$countTask),
];
