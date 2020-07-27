<?php

namespace common\tests\Cities;

use Codeception\Test\Unit;
use common\fixtures\CityFixture;
use taskForce\city\domain\CitiesRepository;

class CitiesListTest extends Unit
{
    /**
     * @var CitiesRepository
     */
    private $cities;

    /**
     * CitiesListTest constructor.
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function __construct()
    {
        $this->cities = \Yii::$container->get(CitiesRepository::class);
        parent::__construct();
    }

    public function _fixtures()
    {
        return [
            'city' => [
                'class' => CityFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/city.php'
            ],
        ];
    }

    public function testGetCityById()
    {
        $city = $this->cities->getCityById(1);
        $this->assertEquals('Кашира',$city->name);
    }

    public function testGetAllCities()
    {
        $cities = $this->cities->getAllCities();
        $this->assertCount(50, $cities);
    }
}
