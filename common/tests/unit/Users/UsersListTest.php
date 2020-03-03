<?php

namespace common\tests\Users;

use Codeception\Test\Unit;
use common\fixtures\CityFixture;
use common\fixtures\RoleFixture;
use common\fixtures\UserFixture;
use frontend\models\User;
use taskForce\user\domain\UsersRepository;

class UsersListTest extends Unit
{
    /**
     * @var UsersRepository
     */
    private $users;

    public function __construct()
    {
        $this->users = \Yii::$container->get(UsersRepository::class);

        parent::__construct();
    }


    public function _fixtures()
    {
        return [
            'city' => [
                'class' => CityFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/city.php'
            ],
            'role' => [
                'class' => RoleFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/role.php'
            ],
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/user.php'
            ]
        ];
    }

    public function testGetListAllUsers()
    {
        $users = $this->users->getAll();

        $this->assertCount(10, $users);
    }

    public function testGetUsersByNameFilter()
    {
        $request = ['name' => 'Розалина'];

        $usersData = $this->users->getByFilter($request);

        $this->assertCount(1, $usersData);
    }

    public function testGetUsersByCityFilter()
    {
        $request = [ 'city' => 48];

        $usersData = $this->users->getByFilter($request);

        $this->assertCount(1, $usersData);
    }

    public function testGetUsersByFilterDifirent()
    {
        $request = ['name' => 'Розалина', 'city' => 48];

        $usersData = $this->users->getByFilter($request);

        $this->assertCount(1, $usersData);
    }

}
