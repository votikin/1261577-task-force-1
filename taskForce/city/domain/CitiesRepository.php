<?php

namespace taskForce\city\domain;

interface CitiesRepository
{
    public function getCityById(int $id): City;

    public function getAllCities(): array;
}
