<?php

namespace taskForce\category\infrastructure;

use frontend\models\Category;
use taskForce\category\domain\CategoriesRepository;

class ArCategoriesRepository implements CategoriesRepository
{
    public function getAll()
    {
        return Category::find()->all();
    }

    public function getAllArray()
    {
        $categoriesData = [];
        foreach ($this->getAll() as $item) {
            $categoriesData[$item->id] =  $item->name;
        }

        return $categoriesData;
    }
}
