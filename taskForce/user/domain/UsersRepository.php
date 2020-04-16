<?php

namespace taskForce\user\domain;

interface UsersRepository
{
    public function getAllExecutors(): array;

    public function getExecutorById(int $id): User;

    public function getExecutorsByFilter(?array $filters): array;

    public function getCustomerByTaskId(int $id): User;

    public function getAuthorByReviewId(int $id): User;

    public function createNewUser(User $user): bool;

    public function getAllUsers(): array;

//    public function getUserCategories(object $user);

//    public function getCountUserReviews(int $id);

//    public function getUserReviews(int $id);

}
