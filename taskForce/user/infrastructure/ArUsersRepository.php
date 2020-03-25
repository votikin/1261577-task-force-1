<?php

namespace taskForce\user\infrastructure;

use frontend\models\Review;
use frontend\models\Task;
use frontend\models\User;
use taskForce\user\domain\UsersRepository;
use taskForce\user\infrastructure\filters\ArUserFilter;
use yii\web\NotFoundHttpException;

class ArUsersRepository implements UsersRepository
{
    public function getById(int $id)
    {
        $user = User::findOne($id);
        if($user === null) {
            throw new NotFoundHttpException("Такого пользователя не существует");
        }

        return $user;
    }

    public function getAll()
    {
        return User::find()->all();
    }

    public function getByFilter(?array $filters)
    {
        $users = User::find()->orderBy('created_at DESC');
        if(!is_null($filters)) {
            $filter = new ArUserFilter($users);
            $users = $filter->apply($filters);
        }

        return $users->all();
    }

    public function getUserCategories(object $user)
    {
        $userCategories = [];
        foreach ($user->categories as $item) {
            $userCategories[] = $item->name;
        }

        return $userCategories;
    }

    public function getCountUserReviews(int $id)
    {
        return Review::find()
                ->joinWith('task')
                ->where([Task::tableName().".executor_id" => $id])
                ->count();
    }
}
