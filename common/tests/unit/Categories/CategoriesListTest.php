<?php

namespace common\tests\Categories;

use Codeception\Test\Unit;
use common\fixtures\CategoryFixture;
use common\fixtures\TaskFixture;
use common\fixtures\UserCategoryFixture;
use common\fixtures\UserFixture;
use taskForce\category\domain\CategoriesRepository;
use taskForce\category\domain\Category;

class CategoriesListTest extends Unit
{
    /**
     * @var CategoriesRepository
     */
    private $categories;

    /**
     * CategoriesListTest constructor.
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function __construct()
    {
        $this->categories = \Yii::$container->get(CategoriesRepository::class);
        parent::__construct();
    }

    public function _fixtures()
    {
        return [
            'category' => [
                'class' => CategoryFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/category.php'
            ],
            'task' => [
                'class' => TaskFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/task.php'
            ],
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/user.php'
            ],
            'user_category' => [
                'class' => UserCategoryFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/user_category.php'
            ],
        ];
    }

    public function testGetListAllCategories()
    {
        $categories = $this->categories->getAll();
        $this->assertCount(8, $categories);
    }

    public function testCheckCategoryByTaskIdIsObject()
    {
        $category = $this->categories->getCategoryByTaskId(5);
        $this->assertIsObject($category);
    }


    public function testGetCategoryByTaskId()
    {
        $category = $this->categories->getCategoryByTaskId(2);
        $this->assertEquals("Переезды",$category->name);
    }

    public function testGetCategoriesByUserId()
    {
        $categories = $this->categories->getCategoriesByUserId(1);
        $this->assertCount(4, $categories);
    }
}
