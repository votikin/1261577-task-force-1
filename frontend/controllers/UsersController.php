<?php

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\User;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $users = User::find()
            ->joinWith('role')
            ->joinWith('userCategories')
            ->joinWith('tasks')
            ->joinWith('reviews')
            ->where(['role.name' => "executor"])
            ->where(['is_hidden' => '0'])
            ->orderBy('created_at DESC')
            ->all();
        $userData = [];
        foreach ($users as $user) {
            $categoriesArray = [];
            foreach ($user->categories as $item) {
                $categoriesArray[] = $item->name;
            }
            $userData[] = [
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
            'model' => $userData,
        ]);
    }
}
