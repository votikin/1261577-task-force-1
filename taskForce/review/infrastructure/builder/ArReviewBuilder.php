<?php

namespace taskForce\review\infrastructure\builder;

use frontend\models\Review as modelReview;
use taskForce\review\domain\Review;
use taskForce\task\infrastructure\builder\ArTaskBuilder;

class ArReviewBuilder
{
    /**
     * @param modelReview $model
     * @return Review
     */
    public function build(modelReview $model): Review
    {
        $review = new Review();
        $taskBuilder = new ArTaskBuilder();
        $review->id = $model->id;
        $review->description = $model->description;
        $review->estimate = $model->estimate;
        $review->task = $taskBuilder->build($model->task);
        $review->isComplete = $model->is_complete;

        return $review;
    }
}
