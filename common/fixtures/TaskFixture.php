<?php

namespace common\fixtures;

use yii\test\ActiveFixture;


class TaskFixture extends ActiveFixture
{
    public $modelClass = 'frontend\models\Task';
    public $depends = [
//        'common\fixtures\UserFixtures',
    ];
}
