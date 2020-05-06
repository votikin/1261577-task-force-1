<?php

namespace taskForce\task\infrastructure;

use frontend\models\Task as modelTask;
use frontend\models\TaskImage;
use frontend\models\TaskStatus;
use taskForce\task\domain\Image;
use taskForce\task\domain\TaskNotFoundException;
use taskForce\task\domain\Task;
use taskForce\task\domain\TasksList;
use taskForce\task\domain\TasksRepository;
use taskForce\task\infrastructure\builder\ArTaskBuilder;
use taskForce\task\infrastructure\filters\ArTaskFilter;
use taskForce\user\domain\TaskNotSaveException;
use taskForce\task\domain\TaskNotDeleteException;
use taskForce\task\domain\TaskImageNotCreateException;

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

    /**
     * @param int $id
     * @return Task
     * @throws TaskNotFoundException
     */
    public function getById(int $id):Task
    {
        $task = modelTask::findOne($id);
        if($task === null) {
            throw new TaskNotFoundException();
        }

        return $this->builder->build($task,true);
    }

    /**
     * @param array|null $filters
     * @return TasksList
     */
    public function getByFilter(array $filters = null): TasksList
    {
        $tasks = modelTask::find()->orderBy('created_at DESC');
        if(!is_null($filters)) {
            $filter = new ArTaskFilter($tasks);
            $tasks = $filter->apply($filters);
        }
        $tasks = $tasks->all();
        $tasksList = new TasksList();
        foreach ($tasks as $task) {
            $tasksList[] = $this->builder->build($task);
        }

        return $tasksList;

    }

    /**
     * @return TasksList
     */
    public function getAll(): TasksList
    {
        $tasks = modelTask::find()->all();
        $tasksList = new TasksList();
        foreach ($tasks as $task) {
            $tasksList[] = $this->builder->build($task);
        }

        return $tasksList;
    }

    /**
     * @param int $id
     * @return int
     */
    public function getCountTasksByExecutorId(int $id): int
    {
        return modelTask::find()->where(['executor_id' => $id])->count();
    }

    /**
     * @param int $id
     * @return int
     */
    public function getCountTasksByCustomerId(int $id): int
    {
        return modelTask::find()->where(['user_id' => $id])->count();
    }

    public function createNewTask(Task $task): Task
    {
        $newTask = new modelTask();
        $newTask->short = $task->shortName;
        $newTask->description = $task->description;
        $newTask->category_id = $task->category->id;
        $newTask->budget = $task->budget;
        $newTask->deadline = $task->deadline;
        $newTask->user_id = $task->author->id;
        $newTask->status_id = TaskStatus::findOne(['name' => TaskStatus::NAME_STATUS_NEW])->id;
        if(!$newTask->save()){
            throw new TaskNotSaveException();
        }

        return $this->builder->build($newTask);
    }

    public function removeTaskById(int $id): bool
    {
        $task = modelTask::findOne($id);
        if($task === null) {
            throw new TaskNotFoundException();
        }
        if(!$task->delete()) {
            throw new TaskNotDeleteException();
        }

        return true;
    }

    public function addTaskImageRows(Image $image): bool
    {
        $taskImage = new TaskImage();
        $taskImage->path = $image->path;
        $taskImage->task_id = $image->task_id;
        if(!$taskImage->save()) {
            throw new TaskImageNotCreateException();
        }

        return true;
    }
}
