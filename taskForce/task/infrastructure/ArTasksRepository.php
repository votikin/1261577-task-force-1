<?php

namespace taskForce\task\infrastructure;

use frontend\models\Task;
use taskForce\task\domain\TasksRepository;
use taskForce\task\infrastructure\filters\ArTaskFilter;
use yii\web\NotFoundHttpException;

class ArTasksRepository implements TasksRepository
{
    public function getByFilter(?array $filters)
    {
        $tasks = Task::find()->orderBy('created_at DESC');;
        if(!is_null($filters)) {
            $filter = new ArTaskFilter($tasks);
            $tasks = $filter->apply($filters);
        }

        return $tasks->all();
    }

    public function getById(int $id)
    {
        $task = Task::findOne($id);
        if($task === null) {
            throw new NotFoundHttpException("Такого задания не существует");
        }

        return $task;
    }

    public function getAll()
    {
        return Task::find()->all();
    }
}
