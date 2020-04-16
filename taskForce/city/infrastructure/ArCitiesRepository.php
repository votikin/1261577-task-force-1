<?php

namespace taskForce\city\infrastructure;

use taskForce\city\domain\CitiesRepository;
use taskForce\city\domain\City;
use frontend\models\City as modelCity;
use taskForce\city\infrastructure\builder\ArCityBuilder;

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
     */
    public function getCityById(int $id): City
    {
        $city = modelCity::findOne($id);

        return $this->builder->build($city);
    }

    public function getAllCities(): array
    {
        $cities = modelCity::find()->all();
        $citiesList = [];
        foreach ($cities as $city) {
            $citiesList[] = $this->builder->build($city);
        }

        return $citiesList;
    }
}
