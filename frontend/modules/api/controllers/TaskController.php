<?php

namespace frontend\modules\api\controllers;

use frontend\models\Task;
use yii\filters\AccessControl;
use yii\rest\ActiveController;

class TaskController extends ActiveController
{
    public $modelClass = Task::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@']
                ]
            ],
        ];

        return $behaviors;
    }

    public function actions()
    {
        $act = parent::actions();
        unset($act['index']);

        return $act;
    }

    public function actionIndex()
    {
        $tasks = Task::find()->all();
        $result = [];
        foreach ($tasks as $task) {
            $temp['title'] = $task->short;
            $temp['published_at'] = $task->created_at;
            $temp['id'] = $task->id;
            $temp['author_id'] = $task->user->name;
            $result[] = $temp;
        }

        return $result;
    }
}
