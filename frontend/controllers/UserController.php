<?php

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\User;

class UserController extends Controller
{
    public function actionIndex()
    {
        $users = User::find()->all();
        foreach ($users as $user) {
            print($user->name);
        }
    }
}
