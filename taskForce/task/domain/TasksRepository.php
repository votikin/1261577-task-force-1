<?php

namespace taskForce\task\domain;

interface TasksRepository
{
    public function getById(int $id) : Task;

    public function getByFilter(array $filters = null): TasksList;

    public function getAll(): TasksList;

    public function getCountTasksByExecutorId(int $id): int;

    public function getCountTasksByCustomerId(int $id): int;

    public function createNewTask(Task $task): Task;

    public function removeTaskById(int $id): bool;

    public function addTaskImageRows(Image $image): bool;
}
