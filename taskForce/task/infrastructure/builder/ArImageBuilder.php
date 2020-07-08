<?php

namespace taskForce\task\infrastructure\builder;

use frontend\models\TaskImage as modelTaskImage;
use taskForce\task\domain\Image;

class ArImageBuilder
{
    public function build(modelTaskImage $model): Image
    {
        $image = new Image();
        $image->path = $model->path;
        $image->task_id = $model->task_id;

        return $image;
    }
}
