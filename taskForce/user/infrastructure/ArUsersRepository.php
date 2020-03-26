<?php

namespace taskForce\user\infrastructure;

<<<<<<< HEAD
use frontend\models\Review;
use frontend\models\Task;
use frontend\models\User;
use taskForce\user\domain\UsersRepository;
use taskForce\user\infrastructure\filters\ArUserFilter;
use yii\web\NotFoundHttpException;
=======
use frontend\models\User;
use taskForce\user\domain\UsersRepository;
use taskForce\user\infrastructure\filters\ArFilterUsers;
>>>>>>> b65ce07df64321bec9cfc7162e598ae9b70d5fc4

class ArUsersRepository implements UsersRepository
{
    public function getById(int $id)
    {
<<<<<<< HEAD
        $user = User::findOne($id);
        if($user === null) {
            throw new NotFoundHttpException("Такого пользователя не существует");
        }

        return $user;
=======
        $user = User::find()->where(['id' => $id]);

        return $id;
>>>>>>> b65ce07df64321bec9cfc7162e598ae9b70d5fc4
    }

    public function getAll()
    {
        return User::find()->all();
    }

<<<<<<< HEAD
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
=======
    public function getByFilter(array $filters)
    {
        $users = User::find();
        $filter = new ArFilterUsers($users);
        $users = $filter->apply($filters);

        return $users->all();
    }
>>>>>>> b65ce07df64321bec9cfc7162e598ae9b70d5fc4
}
