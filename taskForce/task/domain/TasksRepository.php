<?php

namespace taskForce\task\domain;

interface TasksRepository
{
    public function getById(int $id) : Task;

    public function getByFilter(?array $filters): array;

    public function getAll(): array;

    public function getCountTasksByExecutorId(int $id): int;

    public function getCountTasksByCustomerId(int $id): int;
}
