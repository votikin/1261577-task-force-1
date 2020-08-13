<?php

namespace taskForce\city\infrastructure;

use taskForce\city\domain\CitiesList;
use taskForce\city\domain\CitiesRepository;
use taskForce\city\domain\City;
use frontend\models\City as modelCity;
use taskForce\city\infrastructure\builder\ArCityBuilder;
use taskForce\city\domain\exceptions\CityNotFoundException;

class ArCitiesRepository implements CitiesRepository
{
    /**
     * @var ArCityBuilder
     */
    private $builder;

    /**
     * ArCitiesRepository constructor.
     * @param ArCityBuilder $builder
     */
    public function __construct(ArCityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param int $id
     * @return City
     * @throws CityNotFoundException
     */
    public function getCityById(int $id): City
    {
        $city = modelCity::findOne($id);
        if (!$city) {
            throw new CityNotFoundException();
        }

        return $this->builder->build($city);
    }

    /**
     * @return CitiesList
     */
    public function getAllCities(): CitiesList
    {
        $cities = modelCity::find()->all();
        $citiesList = new CitiesList();
        foreach ($cities as $city) {
            $citiesList[] = $this->builder->build($city);
        }

        return $citiesList;
    }
}
