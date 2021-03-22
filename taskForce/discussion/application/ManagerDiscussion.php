<?php

namespace taskForce\discussion\application;

use taskForce\discussion\domain\DiscussionsRepository;

class ManagerDiscussion
{
    /**
     * @var DiscussionsRepository
     */
    private $discussions;

    /**
     * ManagerDiscussion constructor.
     * @param DiscussionsRepository $discussions
     */
    public function __construct(DiscussionsRepository $discussions)
    {
        $this->discussions = $discussions;
    }

    public function setIsViewState(int $task_id, bool $isExecutor)
    {
        $this->discussions->setIsViewState($task_id,$isExecutor);
    }
}
