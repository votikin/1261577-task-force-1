<?php

namespace taskForce\city\infrastructure\builder;

use frontend\models\City as model;
use taskForce\city\domain\City;

class ArCityBuilder
{
    public function build(model $model): City
    {
        $city = new City();
        $city->id = $model->id;
        $city->name = $model->name;

        return $city;
    }
}
