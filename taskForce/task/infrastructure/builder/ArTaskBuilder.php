<?php

namespace taskForce\task\infrastructure\builder;

use frontend\models\Task as modelTask;
use taskForce\category\infrastructure\builder\ArCategoryBuilder;
use taskForce\task\domain\ImageList;
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
        $statusBuilder = new ArStatusBuilder();
        $task->author = $userBuilder->build($model->user);
        $task->id = $model->id;
        $task->shortName = $model->short;
        $task->description = $model->description;
        $task->address = $model->address;
        $task->budget = $model->budget;
        $task->dateCreate = $model->created_at;
        $task->category = $categoryBuilder->build($model->category);
        $task->status = $statusBuilder->build($model->status);

        if($detailView === true) {
            $task->location = new Location($model->latitude, $model->longitude); //dto
            $imageBuilder = new ArImageBuilder();
            $imageList = new ImageList();
            foreach ($model->taskImages as $image) {
                $imageList[] = $imageBuilder->build($image);
            }
            $task->images = $imageList;
        }

        return $task;
    }
}
