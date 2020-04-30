<?php

namespace frontend\controllers;

use frontend\models\LoginForm;
use yii\bootstrap\ActiveForm;
use yii\web\Controller;
use yii\web\Response;

class LandingController extends Controller
{
    public function actionIndex()
    {
        $this->layout = 'landing';
        $loginForm = new LoginForm();
        if (\Yii::$app->request->getIsPost()) {
            $loginForm->load(\Yii::$app->request->post());
            if (\Yii::$app->request->isAjax && $loginForm->load(\Yii::$app->request->post())) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($loginForm);
            }
            if ($loginForm->validate()) {
                $user = $loginForm->getUser();
                \Yii::$app->user->login($user);
                return $this->goHome();
            }
        }

        return $this->render('index', [
            'loginForm' => $loginForm,
        ]);
    }
}
