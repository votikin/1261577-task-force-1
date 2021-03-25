<?php

namespace frontend\modules\api\controllers;

use frontend\models\Discussion;
use frontend\models\Task;
use yii\filters\AccessControl;
use yii\rest\ActiveController;

class TaskController extends ActiveController
{
    public $modelClass = Task::class;

//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//        $behaviors['access'] = [
//            'class' => AccessControl::class,
//            'rules' => [
//                [
//                    'allow' => true,
//                    'roles' => ['@']
//                ]
//            ],
//        ];
//
//        return $behaviors;
//    }

    public function actions()
    {
        $act = parent::actions();
        unset($act['index']);
        unset($act['view']);

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
            $temp['new_messages'] = Discussion::find()->where(['is_executor_view' => '0','task_id' => $task->id])
                ->orWhere(['is_customer_view' => '0','task_id' => $task->id])
                ->count();
            $result[] = $temp;
        }

        return $result;
    }

    public function actionView(int $id)
    {
        $task = Task::findOne(['id' => $id]);
        $result['title'] = $task->short;
        $result['published_at'] = $task->created_at;
        $result['id'] = $task->id;
        $result['author_id'] = $task->user->name;
        $result['new_messages'] = Discussion::find()->where(['is_executor_view' => '0','task_id' => $task->id])
            ->orWhere(['is_customer_view' => '0','task_id' => $task->id])
            ->count();

        return $result;
    }
}
