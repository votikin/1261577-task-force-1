<?php

namespace taskForce\review\application;

use taskForce\review\domain\Review;
use taskForce\review\domain\ReviewsList;
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
     * @return ReviewsList
     */
    public function getReviewsByExecutorId(int $id): ReviewsList
    {
        return $this->review->getReviewsByExecutorId($id);
    }

    public function addNewReview(Review $review): void
    {
        $this->review->addNewReview($review);
    }
}
