<?php

namespace taskForce\task\action;

use frontend\models\TaskStatus;
use taskForce\task\domain\Task;
use taskForce\user\domain\User;

/**
 * Класс действия "На исполнение"
 */
class ExecuteAction extends AbstractAction
{
    public static function getPublicName():string
    {
        return "Выбрать исполнителя";
    }
    public static function getInternalName():string
    {
        return "EXECUTE_ACTION";
    }
    public static function isAvailable(Task $currentTask):bool
    {
        return (
            $currentTask->executor->id === null
            && $currentTask->author->id === \Yii::$app->user->getId()
            && $currentTask->status->name === TaskStatus::NAME_STATUS_NEW
            && $currentTask->countResponses !== 0);
    }
}
