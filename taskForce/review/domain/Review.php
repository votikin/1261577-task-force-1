<?php

namespace taskForce\review\domain;

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
     * @var int
     */
    public $task_id;

    public function toArray()
    {
        return [
            'description' => $this->description,
            'estimate' => $this->estimate,
        ];

    }
}
