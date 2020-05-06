<?php

namespace taskForce\category\domain;

interface CategoriesRepository
{
    public function getAll(): CategoriesList;

    public function getCategoryByTaskId(int $id): Category;

    public function getCategoriesByUserId(int $id): CategoriesList;

    public function getCategoryById(int $id): Category;
}
