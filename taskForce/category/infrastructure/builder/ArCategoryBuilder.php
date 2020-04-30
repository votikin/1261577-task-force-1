<?php

namespace taskForce\category\infrastructure\builder;

use frontend\models\Category as modelCategory;
use taskForce\category\domain\Category;

class ArCategoryBuilder
{
    /**
     * @param modelCategory $model
     * @return Category
     */
    public function build(modelCategory $model): Category
    {
        $category = new Category();
        $category->id = $model->id;
        $category->name = $model->name;
        $category->icon = $model->icon;

        return $category;
    }
}
