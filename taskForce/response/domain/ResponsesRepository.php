<?php

namespace taskForce\response\domain;

interface ResponsesRepository
{
    public function getByTaskId(int $id): ResponsesList;

    public function getUserResponseToTask(int $user_id, int $task_id): ResponsesList;
}
