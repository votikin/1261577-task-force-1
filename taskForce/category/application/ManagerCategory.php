<?php

namespace taskForce\category\application;

use taskForce\category\domain\CategoriesList;
use taskForce\category\domain\CategoriesRepository;
use taskForce\category\domain\Category;

class ManagerCategory
{
    /**
     * @var CategoriesRepository
     */
    private $categories;

    /**
     * ManagerCategory constructor.
     * @param CategoriesRepository $category
     */
    public function __construct(CategoriesRepository $category)
    {
        $this->categories = $category;
    }

    /**
     * @return CategoriesList
     */
    public function getAllCategories(): CategoriesList
    {
        return $this->categories->getAll();
    }

    /**
     * @param int $id
     * @return Category
     */
    public function getCategoryByTaskId(int $id): Category
    {
        return $this->categories->getCategoryByTaskId($id);
    }

    /**
     * @param $id
     * @return CategoriesList
     */
    public function getCategoriesByUserId($id): CategoriesList
    {
        return $this->categories->getCategoriesByUserId($id);
    }

    /**
     * @param int $id
     * @return Category
     */
    public function getCategoryById(int $id): Category
    {
        return $this->categories->getCategoryById($id);
    }

}
