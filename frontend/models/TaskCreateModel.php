<?php

namespace frontend\models;

use frontend\controllers\TestController;
use frontend\modules\api\Api;
use taskForce\task\application\ManagerTask;
use taskForce\task\domain\Location;
use taskForce\user\domain\User;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use taskForce\task\domain\Task;
use taskForce\category\domain\Category;

class TaskCreateModel extends ActiveRecord
{
    /**
     * @var ManagerTask
     */
    private $managerTask;
    public $short;
    public $description;
    public $category_id;

    /**
     * @var UploadedFile[]
     */
    public $files;

    public $location;
    public $budget;
    public $deadline;

    public function init()
    {
        $this->managerTask = \Yii::$container->get(ManagerTask::class);
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
            ['location','string'],
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
            'location' => 'ЛОКАЦИЯ',
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
        $address = Api::mapApi($this->location);
        $location = new Location();
        if($address != '') {
            $coordinates = explode(' ', $address);
            $location->longitude = $coordinates[0];
            $location->latitude = $coordinates[1];
        }
        $task->address = Api::mapApi($location->longitude." ".$location->latitude,'true');
        $task->location = $location;
        $task->budget = $this->budget;
        $task->deadline = $this->deadline;
        $user = new User();
        $user->id = \Yii::$app->user->getId();
        $task->author = $user;
        $task->images = $this->files;

        return $task;
    }
}
