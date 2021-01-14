<?php
namespace frontend\modules\api\controllers;

use frontend\models\User;
use yii\rest\ActiveController;

class ContactsController extends ActiveController
{
    public $modelClass = User::class;
}
