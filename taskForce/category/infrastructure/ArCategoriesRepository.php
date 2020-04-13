<?php

namespace taskForce\category\infrastructure;

use frontend\models\Category as modelCategory;
use frontend\models\Task;
use frontend\models\User as modelUser;
use taskForce\category\domain\CategoriesRepository;
use taskForce\category\domain\Category;
use taskForce\category\infrastructure\builder\ArCategoryBuilder;

class ArCategoriesRepository implements CategoriesRepository
{
    /**
     * @var ArCategoryBuilder
     */
    private $builder;

    /**
     * ArCategoriesRepository constructor.
     * @param ArCategoryBuilder $builder
     */
    public function __construct(ArCategoryBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param int $id
     * @return Category
     */
    public function getCategoryByTaskId(int $id): Category
    {
        $task = Task::findOne($id);
        $category = modelCategory::findOne(['id' => $task->category_id]);

        return $this->builder->build($category);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $categories = modelCategory::find()->all();
        $categoriesList = [];
        foreach ($categories as $category) {
            $categoriesList[] = $this->builder->build($category);
        }

        return $categoriesList;
    }

     /**
     * @param int $id
     * @return array
     */
    public function getCategoriesByUserId(int $id): array
    {
        $userModel = modelUser::findOne($id);
        $userCategories = [];
        foreach ($userModel->categories as $item) {
            $userCategories[] = $this->builder->build($item);
        }

        return $userCategories;
    }
}
