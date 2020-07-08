<?php

namespace taskForce\task\action;

use frontend\models\Response;
use frontend\models\Role;
use frontend\models\TaskStatus;
use taskForce\task\domain\Task;
use taskForce\user\domain\User;

/**
 * Класс действия "Откликнуться"
 */
class ResponseAction extends AbstractAction
{
    public static function getPublicName():string
    {
        return "Откликнуться";
    }
    public static function getInternalName():string
    {
        return "RESPONSE_ACTION";
    }
    public static function isAvailable(Task $currentTask):bool
    {
        $user = \frontend\models\User::findOne(\Yii::$app->user->getId());
        $response = Response::find()->where(['user_id'=>$user->id,'task_id'=>$currentTask->id])->count();

        return (
            $currentTask->executor->id === null
            && $currentTask->status->name === TaskStatus::NAME_STATUS_NEW
            && $currentTask->author->id !== \Yii::$app->user->getId()
            && $user->role->name !== Role::CUSTOMER_ROLE
            && $response === '0'
        );
    }
}
