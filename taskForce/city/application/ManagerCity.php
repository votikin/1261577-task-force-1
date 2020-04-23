<?php

namespace taskForce\city\application;

use taskForce\city\domain\CitiesList;
use taskForce\city\domain\CitiesRepository;
use taskForce\city\domain\City;

class ManagerCity
{
    /**
     * @var CitiesRepository
     */
    private $cities;

    /**
     * ManagerCity constructor.
     * @param CitiesRepository $city
     */
    public function __construct(CitiesRepository $city)
    {
        $this->cities = $city;
    }

    /**
     * @return CitiesList
     */
    public function getAllCities(): CitiesList
    {
        return $this->cities->getAllCities();
    }

    /**
     * @param int $id
     * @return City
     */
    public function getCityById(int $id): City
    {
        return $this->cities->getCityById($id);
    }
}
