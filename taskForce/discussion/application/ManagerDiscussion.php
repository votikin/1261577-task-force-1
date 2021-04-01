<?php

namespace taskForce\discussion\application;

use taskForce\discussion\domain\Discussion;
use taskForce\discussion\domain\DiscussionsList;
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

    public function getCountNewMessagesByTaskId(int $task_id, bool $is_executor = true, bool $allRole = true): int
    {
        return $this->discussions->getCountNewMessageByTaskId($task_id, $is_executor, $allRole);
    }

    public function getDiscussionsByTaskId(int $task_id): DiscussionsList
    {
        return $this->discussions->getDiscussionsByTaskId($task_id);
    }

    public function addNewDiscussion(Discussion $discussion)
    {
        $this->discussions->addNewDiscussion($discussion);
    }
}
