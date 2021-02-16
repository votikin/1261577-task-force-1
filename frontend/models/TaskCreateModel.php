<?php

namespace frontend\models;

use taskForce\city\application\ManagerCity;
use taskForce\share\application\YandexGeo;
use taskForce\task\domain\Location;
use taskForce\user\application\ManagerUser;
use taskForce\user\domain\User;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use taskForce\task\domain\Task;
use taskForce\category\domain\Category;

//TODO Срок исполнения - дата в формате гггг-мм-дд

class TaskCreateModel extends ActiveRecord
{
    /**
     * @var ManagerCity
     */
    private $managerCity;
    /**
     * @var ManagerUser
     */
    private $managerUser;
    public $short;
    public $description;
    public $category_id;

    /**
     * @var UploadedFile[]
     */
    public $files;

    public $formAddress;
    public $budget;
    public $deadline;
    public $cityId;

    public function init()
    {
        $this->managerCity = \Yii::$container->get(managerCity::class);
        $this->managerUser  = \Yii::$container->get(ManagerUser::class);
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['short', 'string', 'min' => 10,'tooShort' => 'Не менее 10 символов'],
            ['description', 'string', 'min' => 30,'tooShort' => 'Не менее 30 символов'],
            ['short', 'required', 'message' => 'Заполните поле'],
            ['description', 'required', 'message' => 'Заполните поле'],
            ['category_id', 'required', 'message' => 'Заполните поле'],
            [['files'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 4],
            ['budget', 'integer'],
            ['deadline', 'safe'],
            ['formAddress','string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'short' => 'МНЕ НУЖНО',
            'description' => 'ПОДРОБНОСТИ ЗАДАНИЯ',
            'category_id' => 'КАТЕГОРИЯ',
            'files' => 'ФАЙЛЫ',
            'formAddress' => 'Адрес в городе '.$this->getUserCity(),
            'budget' => 'БЮДЖЕТ',
            'deadline' => 'СРОК ИСПОЛНЕНИЯ',
        ];
    }

    public function makeNewTask()
    {
        $task = new Task();
        $task->shortName = $this->short;
        $task->description = $this->description;
        $category = new Category();
        $category->id = $this->category_id;
        $task->category = $category;
        $user = new User();
        $user->id = \Yii::$app->user->getId();
        $task->author = $user;
        $task->images = $this->files;
        $location = new Location();
        if ($this->formAddress) {
            $fullAddress = $this->getUserCity() . ", " . $this->formAddress;
            $task->address = $fullAddress;
            $coordinates = explode(' ', YandexGeo::getLocationByAddress($fullAddress));
            if (isset($coordinates[1])) {
                $location->longitude = $coordinates[0];
                $location->latitude = $coordinates[1];
            }
        }
        $task->location = $location;
        $task->budget = $this->budget;
        $task->deadline = $this->deadline;
        $user = $this->managerUser->getUserById(\Yii::$app->user->getId());
        $userCity = $this->managerCity->getCityById($user->cityId);
        $task->cityId = $userCity->id;

        return $task;
    }

    private function getUserCity()
    {
        $user = new User();
        $user = $this->managerUser->getUserById(\Yii::$app->user->getId());

        return $this->managerCity->getCityById($user->cityId)->name;
    }

}
