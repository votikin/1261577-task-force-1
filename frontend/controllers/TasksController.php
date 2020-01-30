<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Task;
use frontend\models\TaskImage;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $tasks = Task::find()->where(['status' => 'Новое'])->orderBy('created_at DESC')->all();
        return $this->render('index', [
            'model' => $tasks,
        ]);

    }
}
