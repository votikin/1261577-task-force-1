<?php

namespace frontend\controllers;

use taskForce\category\application\ManagerCategory;
use taskForce\category\domain\Category;
use taskForce\response\application\ManagerResponse;
use taskForce\response\domain\Response;
use taskForce\task\application\ManagerTask;
use taskForce\task\domain\Task;
use taskForce\user\application\ManagerUser;
use taskForce\user\domain\User;
use Yii;
use yii\web\Controller;
use frontend\models\TaskSearchModel;

class TasksController extends Controller
{
    /**
     * @var ManagerUser
     */
    private $managerUser;

    /**
     * @var ManagerTask
     */
    private $managerTask;

    /**
     * @var ManagerCategory
     */
    private $managerCategory;

    /**
     * @var ManagerResponse
     */
    private $managerResponse;

    public function init()
    {
        $this->managerUser = \Yii::$container->get(ManagerUser::class);
        $this->managerTask = \Yii::$container->get(ManagerTask::class);
        $this->managerCategory = \Yii::$container->get(ManagerCategory::class);
        $this->managerResponse = \Yii::$container->get(ManagerResponse::class);
        parent::init();
    }

    public function actionIndex()
    {
        /**
         * @var $categories Category[]
         * @var $tasks Task[]
         */

        $categories = $this->managerCategory->getAllCategories();
        $categoriesList = [];
        foreach ($categories as $category) {
            $categoriesList[$category->id] = $category->name;
        }

        $tasks = $this->managerTask->getAllTasks();
        $taskSearchModel = new TaskSearchModel();
        $taskSearchModel->load(Yii::$app->request->post());
        if(Yii::$app->request->getIsPost()) {
            $request = Yii::$app->request->post();
            $tasks = $this->managerTask->getTasksByFilter($request['TaskSearchModel']);
        }
        $tasksData = [];
        foreach ($tasks as $task) {
            $tasksData[] = $task->toArray();
        }

        return $this->render('index', [
            'tasksData' => $tasksData,
            'categories' => $categoriesList,
            'taskSearchModel' => $taskSearchModel,
        ]);
    }

    public function actionView(int $id)
    {
        /**
         * @var $task Task
         * @var $customer User
         * @var $responses Response[]
         */
        $task = $this->managerTask->getById($id);
        $customer = $this->managerUser->getCustomerByTaskId($task->id);
        $customerData = [
            'user' => $customer->toArray(),
            'countTasks' => $this->managerTask->getFormatCountTasksByCustomerId($customer->id),
        ];
        $responses = $this->managerResponse->getResponsesByTaskId($id);
        $responsesData = [];
        foreach ($responses as $response) {
            $responsesData[] = $response->toArray();
        }

        return $this->render('view',[
            'taskData' => $task->toArray(),
            'customerData' => $customerData,
            'responsesData' => $responsesData,
        ]);
    }
}
