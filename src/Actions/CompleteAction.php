<?php
    namespace App\Actions;

    use App\Task;
    use App\User;

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
        public static function isAvailable(Task $currentTask, User $user):bool
        {
            return (
                $currentTask->getExecutorId() !== null
                && $currentTask->getCustomerId() === $user->getUserId()
                && $currentTask->getStatus() === $currentTask::EXECUTE_TASK);
        }
	}
