<?php

namespace frontend\controllers;

use frontend\models\SignUpModel;
use taskForce\city\application\ManagerCity;
use taskForce\city\domain\CitiesList;
use taskForce\user\application\ManagerUser;
use Yii;

class SignupController extends AnonimAccessController
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
        $postData = Yii::$app->request->post();
        if ($model->load($postData) && $model->validate()) {
            $this->managerUser->createNewUser($model->makeUser());
            $user = $model->getUser();
            \Yii::$app->user->login($user);

            return $this->goHome();
        }
        $model->password = null;

        return $this->render('index',[
            'signUpModel' => $model,
            'city' => $cities->toArray(),
        ]);
    }
}
