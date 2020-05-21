<?php

namespace taskForce\task\domain;

class Image
{
    /**
     * @var string
     */
    public $path;

    /**
     * @var int
     */
    public $task_id;

    /**
     * Image constructor.
     * @param string|null $path
     * @param int|null $task_id
     */
    public function __construct(string $path = null, int $task_id = null)
    {
        $this->path = $path;
        $this->task_id = $task_id;
    }


    public function toArray()
    {
        return [
            'path' => $this->path,
        ];
    }

}
