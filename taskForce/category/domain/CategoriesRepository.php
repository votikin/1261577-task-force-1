<?php

namespace taskForce\category\domain;


use taskForce\user\domain\User;

interface CategoriesRepository
{
    public function getAll(): array;

    public function getCategoryByTaskId(int $id): Category;

    public function getCategoriesByUserId(int $id): array;
}
