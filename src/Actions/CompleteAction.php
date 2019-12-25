<?php
    namespace App\Actions;

    use App\Task;
    use App\User;
	/**
	* Класс действия "Завершить"
	*/
	class CompleteAction extends AbstractAction
	{
        static public function getPublicName():string {
		    return "Одобрить";
	    }
        static public function getInternalName():string {
		    return "COMPLETE_ACTION";
        }
        static public function isAvailable(Task $currentTask, User $user):bool {
            return ($currentTask->getExecutorId() !== null
                && $currentTask->getCustomerId() === $user->getUserId()
                && $currentTask->getStatus() === $currentTask::EXECUTE_TASK);
        }
	}
