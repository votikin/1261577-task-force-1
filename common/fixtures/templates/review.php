<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

use frontend\models\Task;

$faker->addProvider(new Faker\Provider\ru_RU\Text($faker));
$countTask = Task::find()->count();

return [
    'description' => $faker->realText(100),
    'estimate' => $faker->numberBetween(1,5),
    'task_id' => $faker->numberBetween(1,$countTask),
];
