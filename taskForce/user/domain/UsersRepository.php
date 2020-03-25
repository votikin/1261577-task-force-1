<?php

namespace taskForce\user\domain;

interface UsersRepository
{
    public function getById(int $id);

    public function getAll();

    public function getByFilter(?array $filters);

    public function getUserCategories(object $user);

    public function getCountUserReviews(int $id);
}
