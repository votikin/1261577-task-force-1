<?php

namespace taskForce\task\application;

use taskForce\share\StringHelper;
use taskForce\task\domain\Image;
use taskForce\task\domain\Task;
use taskForce\task\domain\TasksList;
use taskForce\task\domain\TasksRepository;

class ManagerTask
{
    /**
     * @var TasksRepository
     */
    private $task;

    /**
     * ManagerTask constructor.
     * @param TasksRepository $task
     */
    public function __construct(TasksRepository $task)
    {
        $this->task = $task;
    }

    /**
     * @param int $id
     * @return Task
     */
    public function getById(int $id): Task
    {
        return $this->task->getById($id);
    }

    /**
     * @return TasksList
     */
    public function getAllTasks(): TasksList
    {
        return $this->task->getAll();
    }

    /**
     * @param array|null $filters
     * @return TasksList
     */
    public function getTasksByFilter(array $filters = null): TasksList
    {
        return $this->task->getByFilter($filters);
    }

    /**
     * @param int $id
     * @return string
     */
    public function getFormatCountTasksByExecutorId(int $id): string
    {
        $countTasks = $this->task->getCountTasksByExecutorId($id);

        return StringHelper::declensionNum($countTasks,['%d задание','%d задания','%d заданий']);
    }

    /**
     * @param int $id
     * @return string
     */
    public function getFormatCountTasksByCustomerId(int $id): string
    {
        $countTasks = $this->task->getCountTasksByCustomerId($id);

        return StringHelper::declensionNum($countTasks,['%d задание','%d задания','%d заданий']);
    }

    /**
     * @param Task $task
     * @return Task
     */
    public function createNewTask(Task $task): Task
    {
        return $this->task->createNewTask($task);
    }

    public function removeTaskById(int $id): bool
    {
        return $this->task->removeTaskById($id);
    }

    public function addTaskImageRows(Image $image): bool
    {
        return $this->task->addTaskImageRows($image);
    }

}
