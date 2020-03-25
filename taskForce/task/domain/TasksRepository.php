<?php

namespace taskForce\task\domain;

interface TasksRepository
{
    public function getById(int $id);

    public function getByFilter(?array $filters);

    public function getAll();
}
