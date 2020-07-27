<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use taskForce\response\domain\Response;
use taskForce\user\domain\User;

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
            ['comment','safe'],
        ];
    }

    public function makeNewResponse(int $taskId)
    {
        $response = new Response();
        $response->price = $this->price;
        $response->comment = $this->comment;
        $user = new User();
        $user->id = \Yii::$app->user->getId();
        $response->user = $user;
        $response->taskId = $taskId;

        return $response;
    }
}
