<?php

namespace taskForce\review\infrastructure\builder;

use frontend\models\Review as modelReview;
use taskForce\review\domain\Review;

class ArReviewBuilder
{
    public function build(modelReview $model): Review
    {
        $review = new Review();
        $review->id = $model->id;
        $review->description = $model->description;
        $review->estimate = $model->estimate;
        $review->task_id = $model->task_id;

        return $review;
    }
}
