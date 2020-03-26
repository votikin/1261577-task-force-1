<?php

namespace taskForce\user\domain;

interface UsersRepository
{
    public function getById(int $id);

    public function getAll();

<<<<<<< HEAD
    public function getByFilter(?array $filters);

    public function getUserCategories(object $user);

    public function getCountUserReviews(int $id);
=======
    public function getByFilter(array $filter);
>>>>>>> b65ce07df64321bec9cfc7162e598ae9b70d5fc4
}
