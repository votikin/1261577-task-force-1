<?php

namespace frontend\components\widgets;

use yii\base\Widget;

class UserHeader extends Widget
{
    public function run()
    {
        return $this->render('user-header');
    }
}
