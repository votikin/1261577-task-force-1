<?php

namespace taskForce\task\infrastructure;

use frontend\models\Task as modelTask;
use taskForce\share\StringHelper;
use taskForce\task\domain\NotFoundTaskException;
use taskForce\task\domain\Task;
use taskForce\task\domain\TasksRepository;
use taskForce\task\infrastructure\builder\ArTaskBuilder;
use taskForce\task\infrastructure\filters\ArTaskFilter;
use yii\web\NotFoundHttpException;

class ArTasksRepository implements TasksRepository
{
    /**
     * @var ArTaskBuilder
     */
    private $builder;

    /**
     * ArTasksRepository constructor.
     * @param ArTaskBuilder $builder
     */
    public function __construct(ArTaskBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function getById(int $id):Task
    {
        $task = modelTask::findOne($id);
        if($task === null) {
            throw new NotFoundTaskException();
        }

        return $this->builder->build($task,true);
    }


    public function getByFilter(?array $filters): array
    {
        $tasks = modelTask::find()->orderBy('created_at DESC');
        if(!is_null($filters)) {
            $filter = new ArTaskFilter($tasks);
            $tasks = $filter->apply($filters);
        }
        $tasks = $tasks->all();
        $tasksList = [];
        foreach ($tasks as $task) {
            $tasksList[] = $this->builder->build($task);
        }

        return $tasksList;

    }

    public function getAll(): array
    {
        $tasks = modelTask::find()->all();
        $tasksList = [];
        foreach ($tasks as $task) {
            $tasksList[] = $this->builder->build($task);
        }

        return $tasksList;
    }

    public function getCountTasksByExecutorId(int $id): int
    {
        return modelTask::find()->where(['executor_id' => $id])->count();
    }

    public function getCountTasksByCustomerId(int $id): int
    {
        return modelTask::find()->where(['user_id' => $id])->count();
    }
}
