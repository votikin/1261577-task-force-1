<?php

namespace frontend\modules\api\controllers;

use taskForce\task\application\ManagerTask;
use yii\data\ArrayDataProvider;
use yii\rest\ActiveController;

class TasksController extends ActiveController
{
    /**
     * @var ManagerTask
     */
    private $managerTask;

    public function init()
    {
        $this->managerTask = \Yii::$container->get(ManagerTask::class);
    }

    public function actionIndex()
    {
        return new ArrayDataProvider([
            'allModels' => $this->managerTask->getAllTasks()->toArray(),
        ]);
    }
}
