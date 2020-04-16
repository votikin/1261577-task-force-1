<?php

namespace frontend\controllers;

use taskForce\category\application\ManagerCategory;
use taskForce\category\domain\Category;
use taskForce\review\application\ManagerReview;
use taskForce\review\domain\Review;
use taskForce\task\application\ManagerTask;
use taskForce\task\domain\Task;
use taskForce\user\application\ManagerUser;
use taskForce\user\domain\User;
use Yii;
use yii\web\Controller;
use frontend\models\UserSearchModel;

//TODO Выяснить, где лучше собрать userData - в контроллере или менеджере
class UsersController extends Controller
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
         * @var $categories Category[]
         * @var $users User[]
         */
        $userSearchModel = new UserSearchModel();

        $categories = $this->managerCategory->getAllCategories();
        $categoriesList = [];
        foreach ($categories as $category) {
            $categoriesList[$category->id] = $category->name;
        }

        $users = $this->managerUser->getAllExecutors();
        $userSearchModel->load(Yii::$app->request->post());
        if(Yii::$app->request->getIsPost()) {
            $request = Yii::$app->request->post();
            $users = $this->managerUser->getExecutorsByFilter($request['UserSearchModel']);
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
            'categories' => $categoriesList,
            'userSearchModel' => $userSearchModel,
        ]);
    }

    public function actionView(int $id)
    {
        /**
         * @var $user User
         * @var $reviews Review[]
         * @var $reviewTask Task
         */
        $reviews = $this->managerReview->getReviewsByExecutorId($id);
        $reviewsData = [];
        foreach ($reviews as $review){
            $reviewCreator = $this->managerUser->getAuthorByReviewId($review->id);
            $reviewTask = $this->managerTask->getById($review->task_id);
            $reviewsData[] = [
                'review' => $review->toArray(),
                'name' => $reviewCreator->name,
                'avatar' =>$reviewCreator->avatar,
                'task' => $reviewTask->shortName,
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
}

