<?php

namespace taskForce\review\infrastructure;

use frontend\models\Review as modelReview;
use frontend\models\Task;
use taskForce\review\domain\Review;
use taskForce\review\domain\ReviewsList;
use taskForce\review\domain\ReviewsRepository;
use taskForce\review\infrastructure\builder\ArReviewBuilder;
use taskForce\share\Exceptions\NotSaveException;

class ArReviewsRepository implements ReviewsRepository
{
    /**
     * @var ArReviewBuilder
     */
    private $builder;

    /**
     * ArReviewsRepository constructor.
     * @param ArReviewBuilder $builder
     */
    public function __construct(ArReviewBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param int $id
     * @return int
     */
    public function getCountReviewsByExecutorId(int $id): int
    {
        return modelReview::find()
        ->joinWith('task')
        ->where([Task::tableName().".executor_id" => $id])
        ->count();
    }

    /**
     * @param int $id
     * @return ReviewsList
     */
    public function getReviewsByExecutorId(int $id): ReviewsList
    {
        $reviews = modelReview::find()
                    ->joinWith('task')
                    ->where([Task::tableName().".executor_id" => $id])
                    ->all();
        $reviewsList = new ReviewsList();
        foreach ($reviews as $review) {
            $reviewsList[] = $this->builder->build($review);
        }

        return $reviewsList;
    }

    /**
     * @param Review $review
     * @throws NotSaveException
     */
    public function addNewReview(Review $review): void
    {
        $newReview = new modelReview();
        $newReview->description = $review->description;
        $newReview->estimate = $review->estimate;
        $newReview->task_id = $review->task->id;
        $newReview->is_complete = $review->isComplete;
        if(!$newReview->save()) {
            throw new NotSaveException();
        }
    }

}
