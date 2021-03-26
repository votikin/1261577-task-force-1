<?php

namespace taskForce\discussion\domain;

class Discussion
{
    /**
     * @var string
     */
    public $message;

    /**
     * @var \DateTime
     */
    public $created;

    /**
     * @var int
     */
    public $taskId;

    /**
     * @var int
     */
    public $authorId;

    /**
     * @var bool
     */
    public $isExecutorView;

    /**
     * @var bool
     */
    public $isCustomerView;

    public function toArray()
    {
        return [
            'message' => $this->message,
            'createdAt' => $this->created,
            'taskId' => $this->taskId,
            'authorId' => $this->authorId,
            'isExecutorView' => $this->isExecutorView,
            'isCustomerView' => $this->isCustomerView,
        ];
    }
}
