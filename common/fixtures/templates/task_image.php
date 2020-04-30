<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

use frontend\models\Task;

$countTask = Task::find()->count();

return [
    'path' => $faker->imageUrl(),
    'task_id' => $faker->numberBetween(1, $countTask),
];
