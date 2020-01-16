<?php
	namespace App\Actions;

	use App\Task;
    use App\User;

	/**
	* Класс действия "Отменить"
	*/
	class CancelAction extends AbstractAction
	{
        public static function getPublicName():string
        {
	        return "Отменить";
	    }
        public static function getInternalName():string
        {
            return "CANCEL_ACTION";
        }
        public static function isAvailable(Task $currentTask, User $user):bool
        {
            return (
                $currentTask->getExecutorId() === null
                && $currentTask->getCustomerId() === $user->getUserId()
                && $currentTask->getStatus() === $currentTask::NEW_TASK);
        }
	}
