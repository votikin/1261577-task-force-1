<?php

namespace taskForce\discussion\domain;

interface DiscussionsRepository
{
    public function setIsViewState(int $task_id, bool $isExecutor);

    public function getCountNewMessageByTaskId(int $task_id): int;

    public function getDiscussionsByTaskId(int $task_id): DiscussionsList;

    public function addNewDiscussion(Discussion $discussion);
}
