<?php

namespace frontend\modules\api\controllers;

use frontend\models\Discussion;
use yii\filters\AccessControl;
use yii\rest\ActiveController;

class MessageController extends ActiveController
{
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

    public function actionIndex(int $task_id)
    {
        $response = [];
        $discuss = Discussion::find()->where(['task_id' => $task_id])->asArray()->all();
        foreach ($discuss as $item) {
            $temp['message'] = $item['message'];
            $temp['published_at'] = $item['created_at'];
            $temp['is_mine'] = ($item['author_id'] == \Yii::$app->user->getId());
            $temp['id'] = \Yii::$app->user->getId();
            $response[] = $temp;
        }

        return $response;
    }

    public function actionCreate()
    {
        $model = new Discussion();
        $post  = file_get_contents('php://input');
        $res = json_decode("$post");
        $model->message = $res->message;
        $params = \Yii::$app->request->getQueryParams();
        foreach ($params as $param => $value) {
            if($param == 'task_id') {
                $model->task_id = $value;
            }
        }
        $model->author_id = \Yii::$app->user->getId();
        $model->save();
        \Yii::$app->getResponse()->setStatusCode('201');

        return $model;
    }
}

