<?php

namespace taskForce\review\domain;

interface ReviewsRepository
{
    public function getCountReviewsByExecutorId(int $id): int;

    public function getReviewsByExecutorId(int $id): ReviewsList;
}
