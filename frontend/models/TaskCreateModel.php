<?php

namespace frontend\models;

use taskForce\category\application\ManagerCategory;
use taskForce\task\application\ManagerTask;
use taskForce\task\domain\Image;
use taskForce\user\application\ManagerUser;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use taskForce\task\domain\Task;

class TaskCreateModel extends ActiveRecord
{
    /**
     * @var ManagerCategory
     */
    private $managerCategory;

    /**
     * @var ManagerUser
     */
    private $managerUser;

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
        $this->managerCategory = \Yii::$container->get(ManagerCategory::class);
        $this->managerUser = \Yii::$container->get(ManagerUser::class);
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

    public function upload(int $number)
    {
        if($this->validate()) {
            $dbPath = '/img/tasks/' . $number . '/';
            $path = $_SERVER['DOCUMENT_ROOT'] . $dbPath;
            if (!mkdir($path, 0777, true)) {
                return false;
            }
            foreach ($this->files as $file) {
                $dbPathLocal = $dbPath;
                $filePath = $file->baseName . '.' . $file->extension;
                $dbPathLocal .= $filePath;
                $fullPath = $path . $filePath;
                $file->saveAs($fullPath);
                $image = new Image($dbPathLocal, $number);
                $this->managerTask->addTaskImageRows($image);
            }
            return true;
        } else {
            return false;
        }
    }

    public function makeNewTask()
    {
        $task = new Task();
        $task->shortName = $this->short;
        $task->description = $this->description;
        $task->category = $this->managerCategory->getCategoryById($this->category_id);
        $task->location = $this->location;
        $task->budget = $this->budget;
        $task->deadline = $this->deadline;
        $task->author = $this->managerUser->getUserById(\Yii::$app->user->getId());
        $task->images = $this->files;

        return $task;
    }
}
