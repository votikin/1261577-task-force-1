<?php

namespace frontend\controllers;

use frontend\models\SignUpModel;
use taskForce\city\application\ManagerCity;
use taskForce\city\domain\City;
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
         * @var $cities City[]
         */
        $model = new SignUpModel();
        $cities = $this->managerCity->getAllCities();
        $citiesList = [];
        foreach ($cities as $city) {
            $citiesList[] = $city->toArray();
        }

        if (Yii::$app->request->getIsPost()) {
            $model->load(Yii::$app->request->post());

            if ($model->validate()) {
                $user = $model->createUser();
                if($this->managerUser->createNewUser($user)) {
                    return $this->redirect(Yii::$app->getHomeUrl());
                }
            } else{
                $model->password = null;
            }
        }
        return $this->render('index',[
            'signUpModel' => $model,
            'city' => $citiesList,
        ]);
    }
}
