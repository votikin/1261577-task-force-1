<?php

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\User;
use frontend\models\UserImage;
use frontend\models\UserCategory;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $temp = UserImage::find()->all();
//        echo "<pre>";
//        var_dump($temp);
        $users = User::find()->orderBy('created_at DESC')->all();

////      $users = User::find()->with('userImages')->where(['user.id' => 2])->all();
        foreach ($users as $user) {
            echo "<pre>";
            $images = $user->userImages;
            echo $user->name;
            foreach ($images as $item) {
                $item->id;
            }
        }
//        return $this->render('index', [
//            'model' => $users,
//        ]);
    }
}
