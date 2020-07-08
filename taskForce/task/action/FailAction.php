<?php

namespace taskForce\task\action;

use frontend\models\TaskStatus;
use taskForce\task\domain\Task;
use taskForce\user\domain\User;

/**
 * Класс действия "Отказаться"
 */
class FailAction extends AbstractAction
{
    public static function getPublicName():string
    {
        return "Отказаться";
    }
    public static function getInternalName():string
    {
        return "FAIL_ACTION";
    }
    public static function isAvailable(Task $currentTask):bool
    {
        return (
            $currentTask->executor->id === \Yii::$app->user->getId()
            && $currentTask->author->id !== \Yii::$app->user->getId()
            && $currentTask->status->name === TaskStatus::NAME_STATUS_JOB);
    }
}
