<?php

namespace common\tests\Users;

use Codeception\Test\Unit;
use common\fixtures\CityFixture;
use common\fixtures\ReviewFixture;
use common\fixtures\RoleFixture;
use common\fixtures\TaskFixture;
use common\fixtures\UserCategoryFixture;
use common\fixtures\UserFixture;
use frontend\models\User;
use taskForce\user\domain\Contact;
use taskForce\user\domain\UsersRepository;
//TODO как написать тест, который проверит, что возвращается именно доменная сущность
class UsersListTest extends Unit
{
    /**
     * @var UsersRepository
     */
    private $users;

    /**
     * UsersListTest constructor.
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
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
            ],
            'user_category' => [
                'class' => UserCategoryFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/user_category.php'
            ],
            'task' => [
                'class' => TaskFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/task.php'
            ],
            'review' => [
                'class' => ReviewFixture::class,
                'dataFile' => \Yii::$app->getBasePath() . '/fixtures/data/review.php'
            ],
        ];
    }

    public function testGetListAllExecutors()
    {
        $users = $this->users->getAllExecutors();
        $this->assertCount(12,$users);
    }

    public function testGetExecutorById()
    {
        $user = $this->users->getExecutorById(19);
        $this->assertEquals('Шубинa Алексей Андреевич',$user->name);
    }

    public function testGetExecutorsByFilters()
    {
        $request = ['name'=> 'Александрович', 'categories' => ['3','5']];
        $usersData = $this->users->getExecutorsByFilter($request);
        $this->assertCount(1,$usersData);
    }

    public function testGetExecutorsByNameFilter()
    {
        $request = ['name'=> 'Александрович'];
        $usersData = $this->users->getExecutorsByFilter($request);
        $this->assertCount(2,$usersData);
    }

    public function testGetExecutorsByCategoriesFilter()
    {
        $request = ['categories' => ['3','5']];
        $usersData = $this->users->getExecutorsByFilter($request);
        $this->assertCount(4,$usersData);
    }

    public function testGetExecutorsByHasReviewsFilter()
    {
        $request = ['reviews' => '1'];
        $usersData = $this->users->getExecutorsByFilter($request);
        $this->assertCount(5,$usersData);
    }

    public function testCheckExecutorByIdIsUserObject()
    {
        $user = $this->users->getExecutorById(19);
        $this->assertIsObject($user);
    }

    public function testCheckGetCustomerIsObject()
    {
        $user = $this->users->getCustomerByTaskId(4);
        $this->assertIsObject($user);
    }

    public function testGetCustomerByTaskId()
    {
        $user = $this->users->getCustomerByTaskId(4);
        $this->assertEquals('6',$user->id);
    }

    public function testGetReviewAuthor()
    {
        $user = $this->users->getAuthorByReviewId(3);
        $this->assertEquals(9, $user->id);
    }

    public function testGetAllUsers()
    {
        $users = $this->users->getAllUsers();
        $this->assertCount(20,$users);
    }

    public function testCreateUser()
    {
        $newUser = new \taskForce\user\domain\User();
        $newUser->name = 'Вася';
        $newUser->cityId = 12;
        $contact = new Contact('qwe@qwe.ru');
        $newUser->contacts = $contact;
        $newUser->setPassword('qwerty');
        $this->users->createNewUser($newUser);
        $users = $this->users->getAllUsers();
        $this->assertCount(21,$users);
    }



}
