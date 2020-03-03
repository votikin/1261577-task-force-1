<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = 'frontend\models\User';
    public $depends = [
        'common\fixtures\CityFixture',
        'common\fixtures\RoleFixture'
    ];
}
