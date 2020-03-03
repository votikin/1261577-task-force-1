<?php

namespace frontend\controllers;

use taskForce\user\domain\UsersRepository;
use Yii;
use yii\web\Controller;

class UsersController extends Controller
{
    /**
     * @var UsersRepository;
     */
    private $users;

    public function actionIndex()
    {
        $request = Yii::$app->request->post();
        $usersData = $this->users->getByFilter($request);

        return $this->render('index', [
            'usersData' => $usersData,
        ]);
    }

    public function actionDetail()
    {
        $this->users->getById($id);
    }
}
