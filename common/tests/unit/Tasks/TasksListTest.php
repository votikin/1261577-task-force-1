<?php

namespace common\tests\Tasks;

use Codeception\Test\Unit;
use common\fixtures\CategoryFixture;
use common\fixtures\ResponseFixture;
use common\fixtures\TaskFixture;
use common\fixtures\UserFixture;
use taskForce\task\domain\TasksRepository;

class TasksListTest extends Unit
{
    /**
     * @var TasksRepository
     */
    private $tasks;

    public function __construct()
    {
        $this->tasks = \Yii::$container->get(TasksRepository::class);
        parent::__construct();
    }

    public function _fixtures()
    {
        return [
            'task' => [
                'class' => TaskFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/task.php'
            ],
            'category' => [
                'class' => CategoryFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/category.php'
            ],
            'response' => [
                'class' => ResponseFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/response.php'
            ],
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/user.php'
            ],
        ];
    }

    public function testGetAllTasks()
    {
        $tasks = $this->tasks->getAll();
        $this->assertCount(20, $tasks);
    }

    public function testGetTaskById()
    {
        $task = $this->tasks->getById(3);
        $this->assertEquals('4566',$task->budget);
    }

    public function testGetTasksByCategoriesFilter()
    {
        $request = ['categories' => ['1','3']];
        $tasks = $this->tasks->getByFilter($request);
        $this->assertCount(8,$tasks);
    }

    public function testGetTasksByResponsesFilter()
    {
        $request = ['responses' => '1'];
        $tasks = $this->tasks->getByFilter($request);
        $this->assertCount(11,$tasks);
    }

    public function testGetTasksByNameFilter()
    {
        $request = ['name' => 'Манилов'];
        $tasks = $this->tasks->getByFilter($request);
        $this->assertCount(3,$tasks);
    }

    public function testGetTasksByPeriodFilter()
    {
        $request = ['period' => '0'];
        $tasks = $this->tasks->getByFilter($request);
        $this->assertCount(20,$tasks);
    }

    public function testGetTasksByFilters()
    {
        $request = ['name' => 'Манилов','categories' => ['1','8']];
        $tasks = $this->tasks->getByFilter($request);
        $this->assertCount(2,$tasks);
    }

    public function testGetCountTasksByExecutorId()
    {
        $countTasks = $this->tasks->getCountTasksByExecutorId(1);
        $this->assertEquals(1, $countTasks);
    }

    public function testGetCountTasksByCustomerId()
    {
        $countTasks = $this->tasks->getCountTasksByCustomerId(4);
        $this->assertEquals(5, $countTasks);
    }
}
