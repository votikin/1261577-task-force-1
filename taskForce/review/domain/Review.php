<?php

namespace taskForce\review\domain;

use taskForce\task\domain\Task;

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
     * @var Task
     */
    public $task;

    /**
     * Review constructor.
     * @param int|null $id
     * @param string|null $description
     * @param int|null $estimate
     * @param Task|null $task
     */
    public function __construct(int $id = null, string $description = null, int $estimate = null, Task $task = null)
    {
        $this->id = $id;
        $this->description = $description;
        $this->estimate = $estimate;
        $this->task = $task;
    }


    public function toArray()
    {
        return [
            'description' => $this->description,
            'estimate' => $this->estimate,
            'task' => $this->task->toArray(),
        ];

    }
}
