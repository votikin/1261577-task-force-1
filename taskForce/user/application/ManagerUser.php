<?php

namespace taskForce\user\application;

use taskForce\task\domain\Task;
use taskForce\user\domain\User;
use taskForce\user\domain\UsersList;
use taskForce\user\domain\UsersRepository;

class ManagerUser
{
    /**
     * @var UsersRepository
     */
    private $user;

    /**
     * ManagerUser constructor.
     * @param UsersRepository $user
     */
    public function __construct(UsersRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param int $id
     * @return User
     */
    public function getCustomerByTaskId(int $id): User
    {
        return $this->user->getCustomerByTaskId($id);
    }

    /**
     * @return UsersList
     */
    public function getAllExecutors(): UsersList
    {
        return $this->user->getAllExecutors();
    }

    /**
     * @param array|null $filter
     * @return UsersList
     */
    public function getExecutorsByFilter(array $filter = null): UsersList
    {
        return $this->user->getExecutorsByFilter($filter);
    }

    /**
     * @param int $id
     * @return User
     */
    public function getExecutorById(int $id): User
    {
        return $this->user->getExecutorById($id);
    }

    /**
     * @param int $id
     * @return User
     */
    public function getAuthorByReviewId(int $id): User
    {
        return $this->user->getAuthorByReviewId($id);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function createNewUser(User $user): bool
    {
        return $this->user->createNewUser($user);
    }

}
