<?php

namespace frontend\controllers;

use frontend\models\CompleteTaskModel;
use frontend\models\ResponseUserModel;
use frontend\models\TaskStatus;
use taskForce\category\application\ManagerCategory;
use taskForce\category\domain\CategoriesList;
use taskForce\discussion\application\ManagerDiscussion;
use taskForce\response\application\ManagerResponse;
use taskForce\response\domain\ResponsesList;
use taskForce\review\application\ManagerReview;
use taskForce\task\application\ManagerTask;
use taskForce\task\domain\Task;
use taskForce\task\domain\TasksList;
use taskForce\user\application\ManagerUser;
use taskForce\user\domain\User;
use Yii;
use frontend\models\TaskSearchModel;

//TODO Поменять адрес задания, наверное, там должн быть city_id
//TODO Сделать кнопку отмены задания.
//TODO Выяснить, где прописывать преобразование обратное адреса, в контроллере или в домене

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

    /**
     * @var ManagerReview
     */
    private $managerReview;

    /**
     * @var ManagerDiscussion
     */
    private $managerDiscussion;

    public function init()
    {
        $this->managerUser = \Yii::$container->get(ManagerUser::class);
        $this->managerTask = \Yii::$container->get(ManagerTask::class);
        $this->managerCategory = \Yii::$container->get(ManagerCategory::class);
        $this->managerResponse = \Yii::$container->get(ManagerResponse::class);
        $this->managerReview = \Yii::$container->get(ManagerReview::class);
        $this->managerDiscussion = \Yii::$container->get(ManagerDiscussion::class);
        parent::init();
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
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
        if(Yii::$app->request->getIsGet()) {
            $request = Yii::$app->request->get();
            $tasks = $this->managerTask->getTasksByFilter($request);
        } elseif (Yii::$app->request->getIsPost()) {
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

        $userId = Yii::$app->user->getId();
        $completeTaskModel = new CompleteTaskModel();
        $responseUserModel = new ResponseUserModel();
        if($responseUserModel->load(Yii::$app->request->post()) && $this->managerUser->isExecutor($userId)) {
            $this->managerResponse->addNewResponse($responseUserModel->makeNewResponse($id));
            $this->refresh();
        }
        if($completeTaskModel->load(Yii::$app->request->post()) && !$this->managerUser->isExecutor($userId)) {
            if($completeTaskModel->result == CompleteTaskModel::COMPLETE_RESULT) {
                $this->managerTask->setTaskStatus(TaskStatus::NAME_STATUS_COMPLETE,$id);
            } else {
                $this->managerTask->setTaskStatus(TaskStatus::NAME_STATUS_FAIL,$id);
            }
            $this->managerReview->addNewReview($completeTaskModel->makeNewReview($id));
        }
        $task = $this->managerTask->getById($id);
        $customer = $this->managerUser->getCustomerByTaskId($task->id);
        $customerData = [
            'user' => $customer->toArray(),
            'countTasks' => $this->managerTask->getFormatCountTasksByCustomerId($customer->id),
        ];
        $isExecutor = false;

        if(!$this->managerUser->isExecutor($userId)) {
            $responses = $this->managerResponse->getResponsesByTaskId($id);
            $this->managerDiscussion->setIsViewState($id,false);
        } else {
            $responses = $this->managerResponse->getUserResponseToTask($userId, $task->id);
            if(count($responses) !== 0) {
                $isExecutor = true;
                $this->managerDiscussion->setIsViewState($id,true);
            }
        }
        $availableActions = $this->managerTask->getAvailableActions($id);

        return $this->render('view',[
            'taskData' => $task->toArray(),
            'customerData' => $customerData,
            'responsesData' => $responses->toArray(),
            'isExecutor' => $isExecutor,
            'responseUserModel' => $responseUserModel,
            'completeTaskModel' => $completeTaskModel,
            'availableActions' => $availableActions,
        ]);
    }

    public function actionRemoveResponse()
    {
        $responseId = Yii::$app->request->post('responseId');
        if(isset($responseId)) {
            $response = $this->managerResponse->getResponseById($responseId);
            $task = $this->managerTask->getById($response->taskId);
            if (Yii::$app->user->getId() === $task->author->id) {
                $this->managerResponse->refuseResponse($responseId);
            }
        }
    }

    public function actionSetExecutor()
    {
        $userId = Yii::$app->request->post('userId');
        $taskId = Yii::$app->request->post('taskId');
        if(isset($userId) && isset($taskId)) {
            $task = $this->managerTask->getById($taskId);
            if(Yii::$app->user->getId() === $task->author->id) {
                $task = $this->managerTask->setExecutorForTask($userId, $taskId);
            }
        }
    }

    public function actionFailTask()
    {
        $userId = Yii::$app->request->post('userId');
        $taskId = Yii::$app->request->post('taskId');
        if(isset($userId) && isset($taskId)) {
            $this->managerTask->setTaskStatus(TaskStatus::NAME_STATUS_FAIL,$taskId);
        }
    }
}
