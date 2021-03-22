<?php

namespace taskForce\discussion\domain;

interface DiscussionsRepository
{
    public function setIsViewState(int $task_id, bool $isExecutor);
}
