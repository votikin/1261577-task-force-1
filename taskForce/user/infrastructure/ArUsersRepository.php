<?php

namespace taskForce\user\infrastructure;

use frontend\models\User;
use taskForce\user\domain\UsersRepository;
use taskForce\user\infrastructure\filters\ArFilterUsers;

class ArUsersRepository implements UsersRepository
{
    public function getById(int $id)
    {
        $user = User::find()->where(['id' => $id]);

        return $id;
    }

    public function getAll()
    {
        return User::find()->all();
    }

    public function getByFilter(array $filters)
    {
        $users = User::find();
        $filter = new ArFilterUsers($users);
        $users = $filter->apply($filters);

        return $users->all();
    }
}
