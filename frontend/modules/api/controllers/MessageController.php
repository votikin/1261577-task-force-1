<?php

namespace frontend\modules\api\controllers;

use frontend\models\Discussion;
use taskForce\discussion\application\ManagerDiscussion;
use taskForce\user\application\ManagerUser;
use yii\filters\AccessControl;
use yii\rest\ActiveController;

class MessageController extends ActiveController
{
    /**
     * @var ManagerUser
     */
    private $managerUser;

    /**
     * @var ManagerDiscussion
     */
    private $managerDiscussion;

    public $modelClass = Discussion::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@']
                ]
            ],
        ];

        return $behaviors;
    }

    public function actions()
    {
        $act = parent::actions();
        unset($act['index']);
        unset($act['create']);

        return $act;
    }

    public function init()
    {
        parent::init();
        $this->managerUser = \Yii::$container->get(ManagerUser::class);
        $this->managerDiscussion = \Yii::$container->get(ManagerDiscussion::class);
    }

    public function actionIndex(int $task_id)
    {
        $response = [];
        $discuss = $this->managerDiscussion->getDiscussionsByTaskId($task_id);
        foreach ($discuss as $item) {
            $temp['message'] = $item->message;
            $temp['published_at'] = $item->created;
            $temp['is_mine'] = ($item->authorId == \Yii::$app->user->getId());
            $response[] = $temp;
        }

        return $response;
    }

    public function actionCreate()
    {
        $newDiscussion = new \taskForce\discussion\domain\Discussion();
        $post  = file_get_contents('php://input');
        $res = json_decode("$post");
        $newDiscussion->message = $res->message;
        $params = \Yii::$app->request->getQueryParams();
        foreach ($params as $param => $value) {
            if($param == 'task_id') {
                $newDiscussion->taskId = $value;
            }
        }
        $newDiscussion->authorId = \Yii::$app->user->getId();
        if($this->managerUser->isExecutor(\Yii::$app->user->getId())) {
            $newDiscussion->isExecutorView = 1;
            $newDiscussion->isCustomerView = 0;
        } else {
            $newDiscussion->isCustomerView = 1;
            $newDiscussion->isExecutorView = 0;
        }
        $this->managerDiscussion->addNewDiscussion($newDiscussion);
        \Yii::$app->getResponse()->setStatusCode('201');

        return $newDiscussion;
    }
}

