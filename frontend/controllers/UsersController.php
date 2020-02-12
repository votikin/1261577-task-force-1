<?php

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\User;
use frontend\models\Role;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $users = User::find()
            ->joinWith('role')
            ->joinWith('userCategories')
            ->joinWith('tasks')
            ->joinWith('reviews')
            ->where([Role::tableName().".name" => Role::EXECUTOR_ROLE])
            ->where(['is_hidden' => '0'])
            ->orderBy('created_at DESC')
            ->all();
        $usersData = [];
        foreach ($users as $user) {
            $categoriesArray = [];
            foreach ($user->categories as $item) {
                $categoriesArray[] = $item->name;
            }
            $usersData[] = [
                'name' => $user->name,
                'about' => $user->about,
                'address' => $user->address,
                'created_at' => $user->created_at,
                'last_activity' => $user->last_activity,
                "past_time" => $user->getPastActivityTime(),
                'avatar' => $user->avatar,
                'rating' => $user->rating,
                'categories' => $categoriesArray,
                'countTask' => count($user->tasks),
                'countReview' => count($user->reviews)
            ];

        }

        return $this->render('index', [
            'usersData' => $usersData,
        ]);
    }
}
