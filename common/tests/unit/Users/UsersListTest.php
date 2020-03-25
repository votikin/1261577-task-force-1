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
            'city' => [
                'class' => CityFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/city.php'
            ],
            'role' => [
                'class' => RoleFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/role.php'
            ],
        ];
    }

    public function testGetListAllUsers()
    {
        $users = $this->users->getAll();
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
}
