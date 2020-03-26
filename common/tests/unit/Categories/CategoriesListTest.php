<?php

namespace common\tests\Categories;

use Codeception\Test\Unit;
use common\fixtures\CategoryFixture;
use common\fixtures\UserCategoryFixture;
use taskForce\category\domain\CategoriesRepository;

class CategoriesListTest extends Unit
{
    /**
     * @var CategoriesRepository
     */
    private $categories;

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
        ];
    }

    public function testGetListAllCategories()
    {
        $categories = $this->categories->getAll();
        $this->assertCount(8, $categories);
    }

    public function testCategoriesIsArray()
    {
        $categories = $this->categories->getAllArray();
        $this->assertArrayNotHasKey(9,$categories);
    }
}
