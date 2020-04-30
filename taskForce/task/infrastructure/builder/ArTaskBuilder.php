<?php

namespace taskForce\task\infrastructure\builder;

use frontend\models\Task as modelTask;
use frontend\models\User;
use taskForce\category\infrastructure\builder\ArCategoryBuilder;
use taskForce\task\domain\Location;
use taskForce\task\domain\Task;
use taskForce\user\infrastructure\builder\ArUserBuilder;

class ArTaskBuilder
{
    /**
     * @param modelTask $model
     * @param bool $detailView
     * @return Task
     */
    public function build(modelTask $model, $detailView = false): Task
    {
        $task = new Task();
        $categoryBuilder = new ArCategoryBuilder();
        $userBuilder = new ArUserBuilder();
        $task->author = $userBuilder->build($model->user);
        $task->id = $model->id;
        $task->shortName = $model->short;
        $task->description = $model->description;
        $task->address = $model->address;
        $task->budget = $model->budget;
        $task->dateCreate = $model->created_at;
        $task->category = $categoryBuilder->build($model->category);
        if($detailView === true) {
            $task->location = new Location($model->latitude, $model->longitude); //dto
        }

        return $task;
    }
}