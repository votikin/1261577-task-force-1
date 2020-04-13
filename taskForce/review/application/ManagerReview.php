<?php

namespace taskForce\review\application;

use taskForce\review\domain\ReviewsRepository;
use taskForce\share\StringHelper;

class ManagerReview
{
    /**
     * @var ReviewsRepository
     */
    private $review;

    /**
     * ManagerReview constructor.
     * @param ReviewsRepository $review
     */
    public function __construct(ReviewsRepository $review)
    {
        $this->review = $review;
    }

    /**
     * @param int $id
     * @return string
     */
    public function getFormatCountReviewsByExecutorId(int $id): string
    {
        $countReviews = $this->review->getCountReviewsByExecutorId($id);
        return StringHelper::declensionNum($countReviews,['%d отзыв','%d отзыва','%d отзывов']);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getReviewsByExecutorId(int $id): array
    {
        return $this->review->getReviewsByExecutorId($id);
    }

}
