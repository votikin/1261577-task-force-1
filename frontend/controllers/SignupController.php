<?php

namespace frontend\controllers;

use frontend\models\SignUpModel;
use taskForce\city\application\ManagerCity;
use taskForce\city\domain\CitiesList;
use taskForce\user\application\ManagerUser;
use yii\web\Controller;
use Yii;

class SignupController extends Controller
{
    /**
     * @var ManagerCity
     */
    private $managerCity;

    /**
     * @var ManagerUser
     */
    private $managerUser;

    public function init()
    {
        $this->managerCity = \Yii::$container->get(ManagerCity::class);
        $this->managerUser = \Yii::$container->get(ManagerUser::class);
        parent::init();
    }

    public function actionIndex()
    {
        /**
         * @var $cities CitiesList
         */
        $model = new SignUpModel();
        $cities = $this->managerCity->getAllCities();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($this->managerUser->createNewUser($model->makeUser())) {
                    return $this->redirect(Yii::$app->getHomeUrl());
                }
            }
            $model->password = null;
        }

        return $this->render('index',[
            'signUpModel' => $model,
            'city' => $cities->toArray(),
        ]);
    }
}
