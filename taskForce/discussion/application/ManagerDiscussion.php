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

    /**
     * @param int  $task_id
     * @param bool $isExecutor
     */
    public function setIsViewState(int $task_id, bool $isExecutor)
    {
        $this->discussions->setIsViewState($task_id, $isExecutor);
    }

    /**
     * @param int $task_id
     *
     * @return int
     */
    public function getCountNewMessagesByTaskId(int $task_id): int
    {
        return $this->discussions->getCountNewMessageByTaskId($task_id);
    }

    /**
     * @param int $task_id
     *
     * @return DiscussionsList
     */
    public function getDiscussionsByTaskId(int $task_id): DiscussionsList
    {
        return $this->discussions->getDiscussionsByTaskId($task_id);
    }

    /**
     * @param Discussion $discussion
     */
    public function addNewDiscussion(Discussion $discussion)
    {
        $this->discussions->addNewDiscussion($discussion);
    }
}
