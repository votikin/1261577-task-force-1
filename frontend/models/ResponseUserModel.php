<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use taskForce\response\domain\Response;

class ResponseUserModel extends ActiveRecord
{
    public $price;
    public $comment;

    public function attributeLabels()
    {
        return [
            'price' => 'ВАША ЦЕНА',
            'comment' => 'КОММЕНТАРИЙ',
        ];
    }

    public function rules()
    {
        return [
            ['price','integer', 'message' => 'Необходимо целое число'],
        ];
    }

    public function makeNewResponse(int $taskId)
    {
        $response = new Response();
        $response->price = $this->price;
        $response->comment = $this->comment;
        $response->user->id = \Yii::$app->user->getId();
        $response->taskId = $taskId;

        return $response;
    }
}
