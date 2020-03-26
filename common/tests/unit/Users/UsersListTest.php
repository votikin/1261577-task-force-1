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
<<<<<<< HEAD
=======

>>>>>>> b65ce07df64321bec9cfc7162e598ae9b70d5fc4
        parent::__construct();
    }


<<<<<<< HEAD
    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/user.php'
            ],
=======
    public function _fixtures()
    {
        return [
>>>>>>> b65ce07df64321bec9cfc7162e598ae9b70d5fc4
            'city' => [
                'class' => CityFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/city.php'
            ],
            'role' => [
                'class' => RoleFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/role.php'
            ],
<<<<<<< HEAD
=======
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/user.php'
            ]
>>>>>>> b65ce07df64321bec9cfc7162e598ae9b70d5fc4
        ];
    }

    public function testGetListAllUsers()
    {
        $users = $this->users->getAll();
<<<<<<< HEAD
        $this->assertCount(10,$users);
    }

    public function testUsersByFilter()
    {
        $request = ['name'=> 'Мальвина', 'city' => '47'];
        $usersData = $this->users->getByFilter($request);

        $this->assertCount(1,$usersData);
    }

    public function testUsersWithReview()
    {
        $reviews = $this->users->getCountUserReviews(2);
        $this->assertEquals(2,2);
    }
=======

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

>>>>>>> b65ce07df64321bec9cfc7162e598ae9b70d5fc4
}
