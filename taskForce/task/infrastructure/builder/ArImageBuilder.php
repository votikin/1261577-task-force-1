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

        return $image;
    }
}
