<?php

namespace taskForce\task\action;

use frontend\models\TaskStatus;
use taskForce\task\domain\Task;

/**
 * Класс действия "Завершить"
 */
class CompleteAction extends AbstractAction
{
    public static function getPublicName():string
    {
        return "Одобрить";
    }
    public static function getInternalName():string
    {
        return "COMPLETE_ACTION";
    }
    public static function isAvailable(Task $currentTask):bool
    {
        return (
            $currentTask->executor->id !== null
            && $currentTask->author->id === \Yii::$app->user->getId()
            && $currentTask->status->name === TaskStatus::NAME_STATUS_JOB);
    }
}
