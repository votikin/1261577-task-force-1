<?php

namespace taskForce\user\infrastructure;

use frontend\models\Review;
use frontend\models\Role;
use frontend\models\Task;
use frontend\models\User as modelUser;
use taskForce\user\domain\NotFoundUserException;
use taskForce\user\domain\User;
use taskForce\user\domain\UsersRepository;
use taskForce\user\infrastructure\builder\ArUserBuilder;
use taskForce\user\infrastructure\filters\ArUserFilter;

class ArUsersRepository implements UsersRepository
{
    /**
     * @var ArUserBuilder
     */
    private $builder;

    /**
     * ArUsersRepository constructor.
     * @param ArUserBuilder $builder
     */
    public function __construct(ArUserBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function getAllExecutors(): array
    {
        $role = Role::findOne(['name' => Role::EXECUTOR_ROLE]);
        $users = modelUser::find() ->where(['role_id' => $role->id])->all();
        $usersList = [];
        foreach ($users as $user) {
            $usersList[] = $this->builder->build($user);
        }

        return $usersList;
    }

    public function getExecutorById(int $id): User
    {
        $role = Role::findOne(['name' => Role::EXECUTOR_ROLE]);
        $user = modelUser::findOne(['role_id' => $role->id,'id' => $id]);
        if($user === null) {
            throw new NotFoundUserException();
        }
        return $this->builder->build($user,true);
    }


    public function getExecutorsByFilter(?array $filters): array
    {
        $role = Role::findOne(['name' => Role::EXECUTOR_ROLE]);
        $users = modelUser::find()->orderBy('created_at DESC')->where(['role_id' => $role->id]);
        if(!is_null($filters)) {
            $filter = new ArUserFilter($users);
            $users = $filter->apply($filters);
        }
        $users = $users->all();
        $usersList = [];
        foreach ($users as $user) {
            $usersList[] = $this->builder->build($user);
        }

        return $usersList;
    }


    public function getCustomerByTaskId(int $id): User
    {
        $task = Task::findOne($id);
        $user = modelUser::findOne($task->user_id);

        return $this->builder->build($user);
    }

    public function getAuthorByReviewId(int $id): User
    {
        $review = Review::findOne($id);
        $task = Task::findOne($review->task_id);
        $user = modelUser::findOne($task->user_id);

        return $this->builder->build($user);
    }
}
