<?php

namespace taskForce\city\application;

use taskForce\city\domain\CitiesRepository;
use taskForce\city\domain\City;

class ManagerCity
{
    /**
     * @var CitiesRepository
     */
    private $city;

    /**
     * ManagerCity constructor.
     * @param CitiesRepository $city
     */
    public function __construct(CitiesRepository $city)
    {
        $this->city = $city;
    }

    /**
     * @return array
     */
    public function getAllCities(): array
    {
        return $this->city->getAllCities();
    }

    /**
     * @param int $id
     * @return City
     */
    public function getCityById(int $id): City
    {
        return $this->city->getCityById($id);
    }
}
