<?php

namespace frontend\models;

use taskForce\task\application\ManagerTask;
use taskForce\task\domain\Image;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use taskForce\task\domain\Task;

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
        $task->category->id = $this->category_id;
        $task->location = $this->location;
        $task->budget = $this->budget;
        $task->deadline = $this->deadline;
        $task->author->id = \Yii::$app->user->getId();
        $task->images = $this->files;

        return $task;
    }
}
