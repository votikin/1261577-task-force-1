<?php

namespace taskForce\task\application;

use taskForce\share\StringHelper;
use taskForce\task\domain\Task;
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
     * @return array
     */
    public function getAllTasks(): array
    {
        return $this->task->getAll();
    }

    /**
     * @param array|null $filters
     * @return array
     */
    public function getTasksByFilter(?array $filters): array
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

}
