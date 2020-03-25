<?php

namespace taskForce\category\domain;

interface CategoriesRepository
{
    public function getAll();

    public function getAllArray();
}
