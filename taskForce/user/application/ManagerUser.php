<?php

namespace taskForce\user\application;

use taskForce\task\domain\Task;
use taskForce\user\domain\User;
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
     * @return array
     */
    public function getAllExecutors(): array
    {
        return $this->user->getAllExecutors();
    }

    /**
     * @param array|null $filter
     * @return array
     */
    public function getExecutorsByFilter(array $filter = null): array
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

}
