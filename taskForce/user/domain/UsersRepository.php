<?php

namespace taskForce\user\domain;

interface UsersRepository
{
    public function getById(int $id);

    public function getAll();

    public function getByFilter(array $filter);
}
