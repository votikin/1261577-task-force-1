<?php

namespace frontend\controllers;

use frontend\models\Role;
use frontend\models\TaskCreateModel;
use taskForce\category\application\ManagerCategory;
use taskForce\task\application\ManagerTask;
use yii\web\UploadedFile;

class CreateController extends SecuredController
{
    /**
     * @var ManagerCategory
     */
    private $managerCategory;

    /**
     * @var ManagerTask
     */
    public $managerTask;

    public function init()
    {
        $this->managerCategory = \Yii::$container->get(ManagerCategory::class);
        $this->managerTask = \Yii::$container->get(ManagerTask::class);
        parent::init();
    }

    public function behaviors()
    {
        $rules = parent::behaviors();
        $rule = [
            'allow' => false,
            'actions' => ['index'],
            'matchCallback' => function($rule, $action) {
                $role = \Yii::$app->user->identity->role->name;
                return $role !== Role::CUSTOMER_ROLE;
            }
        ];
        array_unshift($rules['access']['rules'], $rule);

        return $rules;
    }

    public function actionIndex()
    {
        $model = new TaskCreateModel();
        $categories = $this->managerCategory->getAllCategories();
        $postData = \Yii::$app->request->post();
        if($model->load($postData) && $model->validate()) {
            $model->files = UploadedFile::getInstances($model, 'files');
            $task = $this->managerTask->createNewTask($model->makeNewTask());
            if($this->managerTask->attachImagesToTask($task->id,$model->files)) {
                $this->goHome();
            } else {
                $this->managerTask->removeTaskById($task->id);
                $model->addError('files', 'Ошибка загрузки файлов, обратитесь к системному администратору.');
            }
        }

        return $this->render('index',[
            'taskCreateModel' => $model,
            'categories' => $categories->toArray(),
        ]);
    }
}
