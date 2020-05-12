<?php

namespace taskForce\user\infrastructure;

use frontend\models\Review;
use frontend\models\Role;
use frontend\models\Task;
use frontend\models\User as modelUser;
use taskForce\user\domain\Contact;
use taskForce\user\domain\UserNotFoundException;
use taskForce\user\domain\UserNotSaveException;
use taskForce\user\domain\User;
use taskForce\user\domain\UsersList;
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

    /**
     * @return UsersList
     */
    public function getAllExecutors(): UsersList
    {
        $role = Role::findOne(['name' => Role::EXECUTOR_ROLE]);
        $users = modelUser::find() ->where(['role_id' => $role->id])->all();
        $usersList = new UsersList();
        foreach ($users as $user) {
            $usersList[] = $this->builder->build($user);
        }

        return $usersList;
    }

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function getExecutorById(int $id): User
    {
        $role = Role::findOne(['name' => Role::EXECUTOR_ROLE]);
        $user = modelUser::findOne(['role_id' => $role->id,'id' => $id]);
        if($user === null) {
            throw new UserNotFoundException();
        }
        return $this->builder->build($user,true);
    }

    /**
     * @param array|null $filters
     * @return UsersList
     */
    public function getExecutorsByFilter(array $filters = null): UsersList
    {
        $role = Role::findOne(['name' => Role::EXECUTOR_ROLE]);
        $users = modelUser::find()->orderBy('created_at DESC')->where(['role_id' => $role->id]);
        if(!is_null($filters)) {
            $filter = new ArUserFilter($users);
            $users = $filter->apply($filters);
        }
        $users = $users->all();
        $usersList = new UsersList();
        foreach ($users as $user) {
            $usersList[] = $this->builder->build($user);
        }

        return $usersList;
    }

    /**
     * @param int $id
     * @return User
     */
    public function getCustomerByTaskId(int $id): User
    {
        $task = Task::findOne($id);
        $user = modelUser::findOne($task->user_id);

        return $this->builder->build($user);
    }

    /**
     * @param int $id
     * @return User
     */
    public function getAuthorByReviewId(int $id): User
    {
        $review = Review::findOne($id);
        $task = Task::findOne($review->task_id);
        $user = modelUser::findOne($task->user_id);

        return $this->builder->build($user);
    }

    /**
     * @param User $user
     * @return bool
     * @throws UserNotSaveException
     */
    public function createNewUser(User $user): User
    {
        $newUser = new modelUser();
        $contact = new Contact($user->contacts->email);
        $newUser->email = $contact->email;
        $newUser->name = $user->name;
        $newUser->password = $user->getPassword();
        $newUser->city_id = $user->cityId;
        if(!$newUser->save()){
            throw new UserNotSaveException();
        }

        return $this->builder->build($newUser);
    }

    /**
     * @return array
     */
    public function getAllUsers(): array
    {
        $users = modelUser::find()->all();
        $usersList = [];
        foreach ($users as $user) {
            $usersList[] = $this->builder->build($user);
        }

        return $usersList;
    }

    public function getUserById(int $id): User
    {
        $user = modelUser::findOne($id);
        if($user === null) {
            throw new UserNotFoundException();
        }

        return $this->builder->build($user,true);
    }

    public function isExecutor(int $id): bool
    {
        $user = modelUser::findOne($id);
        if($user === null) {
            throw new UserNotFoundException();
        }
        $role = Role::findOne($user->role_id);
        if($role->name === Role::CUSTOMER_ROLE) {
            return false;
        }

        return true;
    }
}
