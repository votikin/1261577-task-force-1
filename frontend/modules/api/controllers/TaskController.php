<?php

namespace frontend\modules\api\controllers;

use frontend\models\Task;
use taskForce\discussion\application\ManagerDiscussion;
use taskForce\task\application\ManagerTask;
use yii\filters\AccessControl;
use yii\rest\ActiveController;

class TaskController extends ActiveController
{
    /**
     * @var ManagerDiscussion
     */
    private $managerDiscussion;

    /**
     * @var ManagerTask
     */
    private $managerTask;

    public $modelClass = Task::class;

    public function init()
    {
        $this->managerDiscussion = \Yii::$container->get(ManagerDiscussion::class);
        $this->managerTask = \Yii::$container->get(ManagerTask::class);
        parent::init();
    }

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

        return $act;
    }

    public function actionIndex()
    {
        $tasks = $this->managerTask->getAllTasks();
        $result = [];
        foreach ($tasks as $task) {
            $temp['title'] = $task->shortName;
            $temp['published_at'] = $task->dateCreate;
            $temp['id'] = $task->id;
            $temp['author_id'] = $task->author->name;
            $temp['new_messages'] = $this->managerDiscussion->getCountNewMessagesByTaskId($task->id);
            $result[] = $temp;
        }

        return $result;
    }
}
