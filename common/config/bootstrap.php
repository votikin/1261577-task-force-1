<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@taskForce', dirname(dirname(__DIR__)) . '/taskForce');

Yii::$container->setSingleton('taskForce\user\domain\UsersRepository','taskForce\user\infrastructure\ArUsersRepository');
Yii::$container->setSingleton('taskForce\category\domain\CategoriesRepository','taskForce\category\infrastructure\ArCategoriesRepository');
Yii::$container->setSingleton('taskForce\task\domain\TasksRepository','taskForce\task\infrastructure\ArTasksRepository');
Yii::$container->setSingleton('taskForce\response\domain\ResponsesRepository','taskForce\response\infrastructure\ArResponsesRepository');
Yii::$container->setSingleton('taskForce\review\domain\ReviewsRepository','taskForce\review\infrastructure\ArReviewsRepository');
Yii::$container->setSingleton('taskForce\city\domain\CitiesRepository','taskForce\city\infrastructure\ArCitiesRepository');
