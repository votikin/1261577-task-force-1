<?php

namespace frontend\controllers;

use taskForce\category\application\ManagerCategory;
use taskForce\category\domain\CategoriesList;
use taskForce\review\application\ManagerReview;
use taskForce\review\domain\ReviewsList;
use taskForce\task\application\ManagerTask;
use taskForce\task\domain\Task;
use taskForce\user\application\ManagerUser;
use taskForce\user\domain\User;
use taskForce\user\domain\UsersList;
use Yii;
use frontend\models\UserSearchModel;

class UsersController extends SecuredController
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

    /**
     * @var ManagerReview
     */
    private $managerReview;

    public function init()
    {
        $this->managerCategory = \Yii::$container->get(ManagerCategory::class);
        $this->managerUser = \Yii::$container->get(ManagerUser::class);
        $this->managerTask = \Yii::$container->get(ManagerTask::class);
        $this->managerReview = \Yii::$container->get(ManagerReview::class);
        parent::init();
    }

    public function actionIndex()
    {
        /**
         * @var $categories CategoriesList
         * @var $users UsersList
         */
        $userSearchModel = new UserSearchModel();

        $categories = $this->managerCategory->getAllCategories();
        $userSearchModel->load(Yii::$app->request->post());
        if(Yii::$app->request->getIsPost()) {
            $request = Yii::$app->request->post();
            $users = $this->managerUser->getExecutorsByFilter($request['UserSearchModel']);
        } else {
            $users = $this->managerUser->getAllExecutors();
        }
        $usersData = [];
        foreach ($users as $user) {
            $usersData[] = [
                'user' => $user->toArray(),
                'countTasks' => $this->managerTask->getFormatCountTasksByExecutorId($user->id),
                'countReviews' => $this->managerReview->getFormatCountReviewsByExecutorId($user->id),
            ];
        }

        return $this->render('index',[
            'usersData' => $usersData,
            'categories' => $categories->toIdKeyNameValueArray(),
            'userSearchModel' => $userSearchModel,
        ]);
    }

    public function actionView(int $id)
    {
        /**
         * @var $user User
         * @var $reviews ReviewsList
         * @var $reviewTask Task
         */

        $reviews = $this->managerReview->getReviewsByExecutorId($id);
        $reviewsData = [];
        foreach ($reviews as $review){
            $reviewsData[] = [
                'review' => $review->toArray(),
                'name' => $review->task->author->name,
                'avatar' =>$review->task->author->avatar,
                'task' => $review->task->shortName,
            ];
        }
        $user = $this->managerUser->getExecutorById($id);
        $userData = [
            'user' => $user->toArray(),
            'tasks' => $this->managerTask->getFormatCountTasksByExecutorId($id),
            'reviews' => $this->managerReview->getFormatCountReviewsByExecutorId($id),
        ];

        return $this->render('view', [
            'userData' => $userData,
            'reviewsData' => $reviewsData,
        ]);
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }

}
