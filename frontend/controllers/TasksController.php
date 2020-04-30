<?php

namespace frontend\controllers;

use taskForce\category\application\ManagerCategory;
use taskForce\category\domain\CategoriesList;
use taskForce\response\application\ManagerResponse;
use taskForce\response\domain\ResponsesList;
use taskForce\task\application\ManagerTask;
use taskForce\task\domain\Task;
use taskForce\task\domain\TasksList;
use taskForce\user\application\ManagerUser;
use taskForce\user\domain\User;
use Yii;
use yii\web\Controller;
use frontend\models\TaskSearchModel;

//TODO Поменять адрес задания, наверное, там должн быть city_id

class TasksController extends SecuredController
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
         * @var $categories CategoriesList
         * @var $tasks TasksList
         */

        $categories = $this->managerCategory->getAllCategories();
        $taskSearchModel = new TaskSearchModel();
        $taskSearchModel->load(Yii::$app->request->post());
        if(Yii::$app->request->getIsPost()) {
            $request = Yii::$app->request->post();
            $tasks = $this->managerTask->getTasksByFilter($request['TaskSearchModel']);
        } else {
            $tasks = $this->managerTask->getAllTasks();
        }

        return $this->render('index', [
            'tasksData' => $tasks->toArray(),
            'categories' => $categories->toIdKeyNameValueArray(),
            'taskSearchModel' => $taskSearchModel,
        ]);
    }

    public function actionView(int $id)
    {
        /**
         * @var $task Task
         * @var $customer User
         * @var $responses ResponsesList
         */
        
        $task = $this->managerTask->getById($id);
        $customer = $this->managerUser->getCustomerByTaskId($task->id);
        $customerData = [
            'user' => $customer->toArray(),
            'countTasks' => $this->managerTask->getFormatCountTasksByCustomerId($customer->id),
        ];
        $responses = $this->managerResponse->getResponsesByTaskId($id);

        return $this->render('view',[
            'taskData' => $task->toArray(),
            'customerData' => $customerData,
            'responsesData' => $responses->toArray(),
        ]);
    }
}
