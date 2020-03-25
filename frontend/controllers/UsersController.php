<?php

namespace frontend\controllers;

use taskForce\category\domain\CategoriesRepository;
use taskForce\review\domain\ReviewsRepository;
use taskForce\user\domain\UsersRepository;
use Yii;
use yii\web\Controller;
use frontend\models\UserSearchModel;
use taskForce\share\StringHelper;

class UsersController extends Controller
{
    /**
     * @var UsersRepository
     */
    private $users;

    /**
     * @var CategoriesRepository
     */
    private $categories;

    /**
     * @var ReviewsRepository
     */
    private $reviews;

    public function init()
    {
        $this->users = \Yii::$container->get(UsersRepository::class);
        $this->reviews = \Yii::$container->get(ReviewsRepository::class);
        $this->categories = \Yii::$container->get(CategoriesRepository::class);
        parent::init();
    }

    public function actionIndex()
    {
        $userSearchModel = new UserSearchModel();
        $categoriesData = $this->categories->getAllArray();
        $userSearchModel->load(Yii::$app->request->post());
        if(Yii::$app->request->getIsPost()) {
            $request = Yii::$app->request->post();
            $users = $this->users->getByFilter($request['UserSearchModel']);
        } else {
            $users = $this->users->getAll();
        }
        $usersData = [];
        foreach ($users as $user) {
            $usersData[] = [
                'id' => $user->id,
                'name' => $user->name,
                'about' => $user->about,
                'address' => $user->address,
                'created_at' => $user->created_at,
                'last_activity' => $user->last_activity,
                "past_time" => StringHelper::getPastActivityTime($user->last_activity),
                'avatar' => $user->avatar,
                'rating' => $user->rating,
                'categories' => $this->users->getUserCategories($user),
                'countTask' => StringHelper::declensionNum($user->tasksCount,['%d задание', '%d задания', '%d заданий']),
                'countReview' => StringHelper::declensionNum($this->users->getCountUserReviews($user->id),
                    ['%d отзыв', '%d отзыва', '%d отзывов']),
            ];
        }

        return $this->render('index',[
            'usersData' => $usersData,
            'categories' => $categoriesData,
            'userSearchModel' => $userSearchModel,
        ]);
    }

    public function actionView(int $id)
    {
        $user = $this->users->getById($id);
        $reviews = $this->reviews->getReviewsByExecutorId($id);
        $reviewsData = [];
        foreach ($reviews as $review){
            $reviewCreator = $this->users->getById($review->task->user_id);
            $reviewsData[] = [
                'description' => $review->description,
                'estimate' => $review->estimate,
                'name' => $reviewCreator->name,
                'avatar' => $reviewCreator->avatar,
                'task' => $review->task->short
            ];
        }
        $userData = [
            'avatar' => $user->avatar,
            'name' => $user->name,
            'rating' => $user->rating,
            'past_time' => StringHelper::getPastActivityTime($user->last_activity),
            'countTask' => StringHelper::declensionNum($user->tasksCount,['%d заказ', '%d заказа', '%d заказов']),
            'countReview' => StringHelper::declensionNum($this->users->getCountUserReviews($user->id),
                ['%d отзыв', '%d отзыва', '%d отзывов']),
            'about' => $user->about,
            'categories' => $this->users->getUserCategories($user),
            'phone' => $user->phone,
            'email' => $user->email,
            'skype' => $user->skype,
            'reviewsCount' => count($reviewsData),
        ];

        return $this->render('view', [
            'userData' => $userData,
            'reviewsData' => $reviewsData,
        ]);
    }
}

