<?php

namespace frontend\controllers;

use frontend\models\TaskStatus;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use taskForce\task\application\ManagerTask;
use taskForce\user\application\ManagerUser;
use yii\helpers\Url;

class MyListController extends SecuredController
{
    /**
     * @var ManagerTask
     */
    private $managerTask;

    /**
     * @var ManagerUser
     */
    private $managerUser;

    public function init()
    {
        $this->managerTask = \Yii::$container->get(ManagerTask::class);
        $this->managerUser = \Yii::$container->get(ManagerUser::class);
        parent::init();
    }

    public function actionIndex(string $status = 'new')
    {
        $user_id = \Yii::$app->user->getId();
        $tasks = $this->managerTask->getUsersTasksByStatus($status, $user_id);

        $url = \Yii::$app->request->hostInfo."/api/tasks";
        $client = new Client([
            'base_uri' => $url,
        ]);

        $tasksData = [];
        foreach ($tasks as $task) {
            $tasksData[] = $task->toArray();
            $request = new Request('GET',$task->id);
            $response = $client->send($request);
            $content = $response->getBody()->getContents();
            $response_data = json_decode($content);
            echo "<pre>";
            var_dump($response_data);
            die();
        }

        $response = $client->get();
        $content = $response->getBody()->getContents();
        $response_data = json_decode($content);
//
        echo "<pre>";
        var_dump($response_data);
        die();

        return $this->render('index',[
            'tasksData' => $tasks->toArray(),
        ]);
    }
}
