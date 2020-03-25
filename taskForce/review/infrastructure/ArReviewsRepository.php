<?php

namespace taskForce\review\infrastructure;

use frontend\models\Review;
use frontend\models\Task;
use taskForce\review\domain\ReviewsRepository;

class ArReviewsRepository implements ReviewsRepository
{

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function getReviewsByExecutorId(int $id)
    {
        return Review::find()
        ->joinWith('task')
        ->where([Task::tableName().".executor_id" => $id])
        ->all();
    }
}
