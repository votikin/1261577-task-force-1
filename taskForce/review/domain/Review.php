<?php

namespace taskForce\review\domain;

use taskForce\task\domain\Task;
use taskForce\task\domain\TasksList;

class Review
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $estimate;

    /**
     * @var TasksList
     */
    public $task;

    public function toArray()
    {
        return [
            'description' => $this->description,
            'estimate' => $this->estimate,
            'task' => $this->task->toArray(),
        ];

    }
}
