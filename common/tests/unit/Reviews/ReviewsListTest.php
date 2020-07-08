<?php

namespace common\tests\Reviews;

use Codeception\Test\Unit;
use common\fixtures\CategoryFixture;
use common\fixtures\ReviewFixture;
use common\fixtures\TaskFixture;
use common\fixtures\TaskStatusFixture;
use common\fixtures\UserFixture;
use taskForce\review\domain\ReviewsRepository;

class ReviewsListTest extends Unit
{
    /**
     * @var ReviewsRepository
     */
    private $reviews;

    /**
     * ReviewsListTest constructor.
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function __construct()
    {
        $this->reviews = \Yii::$container->get(ReviewsRepository::class);
        parent::__construct();
    }

    public function _fixtures()
    {
        return [
            'review' => [
                'class' => ReviewFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/review.php'
            ],
            'task' => [
                'class' => TaskFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/task.php'
            ],
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/user.php'
            ],
            'category' => [
                'class' => CategoryFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/category.php'
            ],
            'task_status' => [
                'class' => TaskStatusFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/task_status.php'
            ],
        ];
    }

    public function testGetCountReviewsByExecutorId()
    {
        $countReviews = $this->reviews->getCountReviewsByExecutorId(3);
        $this->assertEquals(3,$countReviews);
    }

    public function testGetReviewsByExecutorId()
    {
        $reviews = $this->reviews->getReviewsByExecutorId(3);
        $this->assertCount(3, $reviews);
    }
}
