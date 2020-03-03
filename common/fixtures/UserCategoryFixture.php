<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class UserCategoryFixture extends ActiveFixture
{
    public $modelClass = 'frontend\models\UserCategory';
    public $depends = [
        'common\fixtures\CategoryFixture',
        'common\fixtures\UserFixture'
    ];
}
