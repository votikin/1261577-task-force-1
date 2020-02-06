<?php

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Task;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $tasks = Task::find()
            ->joinWith('status') //status - это имя связи
            ->joinWith('category')
            ->where(['task_status.name' => "Новое"])
            ->orderBy('created_at DESC')
            ->all();
        $userData = [];
        foreach ($tasks as $task) {
            $userData[] = [
                'short' => $task->short,
                'description' => $task->description,
                'address' => $task->address,
                'budget' => $task->budget,
                'deadline' => $task->deadline,
                'latitude' => $task->latitude,
                'longitude' => $task->longitude,
                'updated_at' => $task->updated_at,
                'pastTime' => $task->getPastTime(),
                'status_name' => $task->status['name'],
                'category_name' => $task->category['name'],
                'category_icon' => $task->category['icon'],
            ];
        }
        return $this->render('index', [
            'model' => $userData,
        ]);
    }
}
