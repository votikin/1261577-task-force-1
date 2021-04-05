<?php

namespace taskForce\discussion\infrastructure\builder;

use frontend\models\Discussion as modelDiscussion;
use taskForce\discussion\domain\Discussion;

class ArDiscussionBuilder
{
    public function build(modelDiscussion $model): Discussion
    {
        $discussion = new Discussion();
        $discussion->message = $model->message;
        $discussion->created = $model->created_at;
        $discussion->taskId = $model->task_id;
        $discussion->authorId = $model->author_id;
        $discussion->isCustomerView = $model->is_customer_view;
        $discussion->isExecutorView = $model->is_executor_view;

        return $discussion;
    }
}
