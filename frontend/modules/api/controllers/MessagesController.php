<?php

namespace frontend\modules\api\controllers;

use frontend\models\Discussion;
use yii\rest\ActiveController;

class MessagesController extends ActiveController
{
    public $modelClass = Discussion::class;
}
