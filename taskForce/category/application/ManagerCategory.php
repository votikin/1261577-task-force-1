<?php

namespace taskForce\category\application;

use taskForce\category\domain\CategoriesRepository;
use taskForce\category\domain\Category;

class ManagerCategory
{
    /**
     * @var CategoriesRepository
     */
    private $category;

    /**
     * ManagerCategory constructor.
     * @param CategoriesRepository $category
     */
    public function __construct(CategoriesRepository $category)
    {
        $this->category = $category;
    }

    /**
     * @return array
     */
    public function getAllCategories(): array
    {
        return $this->category->getAll();
    }

    /**
     * @param int $id
     * @return Category
     */
    public function getCategoryByTaskId(int $id): Category
    {
        return $this->category->getCategoryByTaskId($id);
    }

    /**
     * @param $id
     * @return array
     */
    public function getCategoriesByUserId($id): array
    {
        return $this->category->getCategoriesByUserId($id);
    }

}
