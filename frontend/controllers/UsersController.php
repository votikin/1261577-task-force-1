<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\User;
use frontend\models\Role;
use frontend\models\Category;
use frontend\models\UserCategory;
use frontend\models\UserSearchModel;
use taskForce\share\StringHelper;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $userSearchModel = new UserSearchModel();
        $users = User::find()
            ->joinWith('role')
            ->joinWith('userCategories')
            ->joinWith('tasks')
            ->where([Role::tableName().".name" => Role::EXECUTOR_ROLE])
            ->andWhere(['is_hidden' => '0'])
            ->orderBy('created_at DESC');

        if(Yii::$app->request->getIsPost()) {
            $userSearchModel->load(Yii::$app->request->post());
            if (!empty($userSearchModel->categories)) {
                $users = $users->andWhere([UserCategory::tableName().".category_id" => $userSearchModel->categories]);
            }
            if($userSearchModel->reviews === "1") {
                $users = $users->andWhere(['has_review' => 1]);
            }
            if(!empty($userSearchModel->name)) {
                $users = $users->andWhere(['like',User::tableName().'.name', $userSearchModel->name]);
            }
        }
        $users = $users->all();
        $usersData = [];
        foreach ($users as $user) {

//  НЕ УДАЛИЛ, ПОТОМУ ЧТО НЕ ЗНАЮ, КАК ЛУЧШЕ, ТАК ИЛИ КАК ДАЛЬШЕ
//            $reviews = Review::find()
//                ->joinWith('task')
//                ->where([Task::tableName().".executor_id" => $user->id])
//                ->count();

            $reviews = 0;
            foreach ($user->tasks as $task) {
                $reviews += $task->ReviewsCount;
            }
            $categoriesArray = [];
            foreach ($user->categories as $item) {
                $categoriesArray[] = $item->name;
            }
            $usersData[] = [
                'id' => $user->id,
                'name' => $user->name,
                'about' => $user->about,
                'address' => $user->address,
                'created_at' => $user->created_at,
                'last_activity' => $user->last_activity,
                "past_time" => $user->getPastActivityTime(),
                'avatar' => $user->avatar,
                'rating' => $user->rating,
                'categories' => $categoriesArray,
                'countTask' => StringHelper::declensionNum($user->tasksCount,['%d задание', '%d задания', '%d заданий']),
                'countReview' => StringHelper::declensionNum($reviews,['%d отзыв', '%d отзыва', '%d отзывов']),
            ];
        }
        $categoriesName = [];
        $categories = Category::find()->all();
        foreach ($categories as $item) {
            $categoriesName[$item['id']] =  $item['name'];
        }

        return $this->render('index', [
            'usersData' => $usersData,
            'categories' => $categoriesName,
            'userSearchModel' => $userSearchModel,
        ]);
    }
}
