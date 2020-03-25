<?php

namespace frontend\controllers;

use taskForce\category\domain\CategoriesRepository;
use taskForce\response\domain\ResponsesRepository;
use taskForce\share\StringHelper;
use taskForce\task\domain\TasksRepository;
use taskForce\user\domain\UsersRepository;
use Yii;
use yii\web\Controller;
use frontend\models\Task;
use frontend\models\TaskStatus;
use frontend\models\TaskSearchModel;
use frontend\models\Response;

class TasksController extends Controller
{
    /**
     * @var CategoriesRepository
     */
    private $categories;

    /**
     * @var TasksRepository
     */
    private $tasks;

    /**
     * @var UsersRepository
     */
    private $users;

    /**
     * @var ResponsesRepository
     */
    private $responses;

    public function init()
    {
        $this->categories = \Yii::$container->get(CategoriesRepository::class);
        $this->tasks = \Yii::$container->get(TasksRepository::class);
        $this->users = \Yii::$container->get(UsersRepository::class);
        $this->responses = \Yii::$container->get(ResponsesRepository::class);
        parent::init();
    }

    public function actionIndex()
    {
        $taskSearchModel = new TaskSearchModel();
        $categoriesName = $this->categories->getAllArray();
        $taskSearchModel->load(Yii::$app->request->post());
        if(Yii::$app->request->getIsPost()) {
            $request = Yii::$app->request->post();
            $tasks = $this->tasks->getByFilter($request['TaskSearchModel']);
        } else {
            $tasks = $this->tasks->getAll();
        }
        $tasksData = [];
        foreach ($tasks as $task) {
            $tasksData[] = [
                'id' => $task->id,
                'short' => $task->short,
                'description' => $task->description,
                'address' => $task->address,
                'budget' => $task->budget,
                'deadline' => $task->deadline,
                'latitude' => $task->latitude,
                'longitude' => $task->longitude,
                'updated_at' => $task->updated_at,
                'pastTime' => StringHelper::getPastTime($task->created_at),
                'status_name' => $task->status->name,
                'category_name' => $task->category->name,
                'category_icon' => $task->category->icon,
            ];
        }

        return $this->render('index', [
            'tasksData' => $tasksData,
            'categories' => $categoriesName,
            'taskSearchModel' => $taskSearchModel,
        ]);
    }

    public function actionView(int $id)
    {
        $task = $this->tasks->getById($id);
        $customer = $this->users->getById($task->user_id);
        $responses = $this->responses->getByTaskId($task->id);
        $responsesData = [];
        foreach ($responses as $response) {
            $responseUser = $this->users->getById($response->user_id);
            $responsesData[] = [
                'price' => $response->price,
                'comment' => $response->comment,
                'pastTime' => StringHelper::getPastTime($response->created_at),
                'name' => $responseUser->name,
                'rating' => $responseUser->rating,
                'avatar' => $responseUser->avatar,
            ];
        }
        $customerData = [
            'avatar' => $customer->avatar,
            'name' => $customer->name,
            'countTasks' => $customer->customerTasksCount,
            'registrationPast' => StringHelper::getRegistrationPastTime($customer->created_at),
        ];
        $taskData = [
            'short' => $task->short,
            'description' => $task->description,
            'address' => $task->address,
            'budget' => $task->budget,
            'deadline' => $task->deadline,
            'latitude' => $task->latitude,
            'longitude' => $task->longitude,
            'updated_at' => $task->updated_at,
            'pastTime' => StringHelper::getPastTime($task->created_at),
            'status_name' => $task->status->name,
            'category_name' => $task->category->name,
            'category_icon' => $task->category->icon,
            'responsesCount' => $task->responsesCount,
        ];

        return $this->render('view',[
            'taskData' => $taskData,
            'customerData' => $customerData,
            'responsesData' => $responsesData,
        ]);
    }
}
