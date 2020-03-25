<?php

namespace taskForce\review\domain;

interface ReviewsRepository
{
    public function getAll();

    public function getReviewsByExecutorId(int $id);
}
