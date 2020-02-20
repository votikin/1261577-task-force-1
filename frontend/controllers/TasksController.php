<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Category;
use yii\web\Controller;
use frontend\models\Task;
use frontend\models\TaskStatus;
use frontend\models\TaskSearchModel;
use frontend\models\Response;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $taskSearchModel = new TaskSearchModel();
        $tasks = Task::find()
            ->joinWith('status')
            ->joinWith('category')
            ->joinWith('responses')
            ->where([TaskStatus::tableName().".name" => TaskStatus::NAME_STATUS_NEW])
            ->orderBy('created_at DESC');

        if(Yii::$app->request->getIsPost()) {
            $taskSearchModel->load(Yii::$app->request->post());
            if(!empty($taskSearchModel->categories)) {
                $tasks = $tasks->andWhere(['category_id' => $taskSearchModel->categories]);
            }
            if($taskSearchModel->responses === "1") {
                $tasks = $tasks->andWhere([Response::tableName().'.id' => null]);
            }
            if(!empty($taskSearchModel->name)) {
                $tasks = $tasks->andWhere(['like',Task::tableName().'.short', $taskSearchModel->name]);
                //надо ли искать по полю description? И если да, то как составить запрос, чтобы
                //искало совпадение либо в поле short, либо в description. При этом другие условия остались.
            }
            if($taskSearchModel->period !== "0"){
                $currentTime = new \DateTime();
                $needTime = new \DateTime();
                switch ($taskSearchModel->period){
                    case "1":
                        $needTime->modify('-1 year');
                        break;
                    case "2":
                        $needTime->modify('-1 month');
                        break;
                    case "3":
                        $needTime->modify('-1 day');
                        break;
                }
                $tasks = $tasks->andWhere(['between',Task::tableName().'.created_at',
                    $needTime->format('c'),$currentTime->format('c')
                ]);
            }
        }
        $tasks = $tasks->all();
        $tasksData = [];
        foreach ($tasks as $task) {
            $tasksData[] = [
                'short' => $task->short,
                'description' => $task->description,
                'address' => $task->address,
                'budget' => $task->budget,
                'deadline' => $task->deadline,
                'latitude' => $task->latitude,
                'longitude' => $task->longitude,
                'updated_at' => $task->updated_at,
                'pastTime' => $task->getPastTime(),
                'status_name' => $task->status->name,
                'category_name' => $task->category->name,
                'category_icon' => $task->category->icon,
            ];
        }
        $categoriesName = [];
        $categories = Category::find()->all();
        foreach ($categories as $item) {
            $categoriesName[$item['id']] =  $item['name'];
        }

        return $this->render('index', [
            'tasksData' => $tasksData,
            'categories' => $categoriesName,
            'taskSearchModel' => $taskSearchModel,
        ]);
    }
}
