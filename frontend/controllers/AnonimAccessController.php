<?php

namespace frontend\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

abstract class AnonimAccessController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?']
                    ]
                ],
                'denyCallback' => function ($rule, $action) {
                    return $this->goHome();
                }
            ],
        ];
    }
}

