<?php

namespace taskForce\discussion\infrastructure;

use frontend\models\Discussion;
use taskForce\discussion\domain\DiscussionsRepository;
use taskForce\share\Exceptions\NotSaveException;

class ArDiscussionsRepository implements DiscussionsRepository
{
    public function setIsViewState(int $task_id, bool $isExecutor)
    {
        if($isExecutor == true) {
            $discussions = Discussion::find()->where(['task_id' => $task_id, 'is_executor_view' => '0'])->all();
            foreach ($discussions as $discussion) {
                $discussion->is_executor_view = 1;
                if (!$discussion->save()) {
                    throw new NotSaveException();
                }
            }
        } else {
            $discussions = Discussion::find()->where(['task_id' => $task_id, 'is_customer_view' => '0'])->all();
            foreach ($discussions as $discussion) {
                $discussion->is_customer_view = 1;
                if (!$discussion->save()) {
                    throw new NotSaveException();
                }
            }
        }
    }
}
