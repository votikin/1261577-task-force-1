<?php

namespace taskForce\discussion\infrastructure;

use frontend\models\Discussion as modelDiscussion;
use taskForce\discussion\domain\Discussion;
use taskForce\discussion\domain\DiscussionsList;
use taskForce\discussion\domain\DiscussionsRepository;
use taskForce\discussion\infrastructure\builder\ArDiscussionBuilder;
use taskForce\share\Exceptions\NotSaveException;

class ArDiscussionsRepository implements DiscussionsRepository
{
    /**
     * @var ArDiscussionBuilder
     */
    private $builder;

    /**
     * ArDiscussionsRepository constructor.
     *
     * @param ArDiscussionBuilder $builder
     */
    public function __construct(ArDiscussionBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param int  $task_id
     * @param bool $isExecutor
     */
    public function setIsViewState(int $task_id, bool $isExecutor)
    {
        if ($isExecutor == true) {
            modelDiscussion::updateAll(['is_executor_view' => 1],['task_id' => $task_id, 'is_executor_view' => '0']);
        } else {
            modelDiscussion::updateAll(['is_customer_view' => 1],['task_id' => $task_id, 'is_customer_view' => '0']);
        }
    }

    /**
     * @param int $task_id
     *
     * @return int
     */
    public function getCountNewMessageByTaskId(int $task_id): int
    {
        return modelDiscussion::find()->where(['is_executor_view' => '0','task_id' => $task_id])
            ->orWhere(['is_customer_view' => '0','task_id' => $task_id])
            ->count();
    }

    /**
     * @param int $task_id
     *
     * @return DiscussionsList
     */
    public function getDiscussionsByTaskId(int $task_id): DiscussionsList
    {
        $discussions = modelDiscussion::find()->where(['task_id' => $task_id])->all();
        $discussionsList = new DiscussionsList();
        foreach ($discussions as $discussion) {
            $discussionsList[] = $this->builder->build($discussion);
        }

        return $discussionsList;
    }

    /**
     * @param Discussion $discussion
     *
     * @throws NotSaveException
     */
    public function addNewDiscussion(Discussion $discussion)
    {
        $newDisc = new modelDiscussion();
        $newDisc->message = $discussion->message;
        $newDisc->task_id = $discussion->taskId;
        $newDisc->author_id = $discussion->authorId;
        $newDisc->is_executor_view = $discussion->isExecutorView;
        $newDisc->is_customer_view = $discussion->isCustomerView;
        if (!$newDisc->save()){
            throw new NotSaveException();
        }
    }
}
