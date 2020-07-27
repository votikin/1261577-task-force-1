<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class TaskImageFixture extends ActiveFixture
{
    public $modelClass = 'frontend\models\TaskImage';
    public $depends = [
        'common\fixtures\TaskFixture',
    ];
}

