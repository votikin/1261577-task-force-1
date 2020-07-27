<?php

namespace frontend\components\widgets;

use yii\base\Widget;

class ResponsesButtons extends Widget
{
    public $response;
    public $task;

    public function run()
    {
        return $this->render('responses-buttons',[
            'id' => $this->response['id'],
            'user' => $this->response['user']['id'],
            'task' => $this->task,
        ]);
    }
}
