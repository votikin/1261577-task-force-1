<?php

namespace taskForce\response\domain;

interface ResponsesRepository
{
    public function getByTaskId(int $id);
}
