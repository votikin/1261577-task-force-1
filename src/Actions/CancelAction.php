<?php
	namespace App\Actions;

	use App\Task;
    use App\User;
	/**
	* Класс действия "Отменить"
	*/
	class CancelAction extends AbstractAction
	{
	    static public function getPublicName():string {
	        return "Отменить";
	    }
        static public function getInternalName():string {
            return "CANCEL_ACTION";
        }
        static public function isAvailable(Task $currentTask, User $user):bool {
            return ($currentTask->getExecutorId() === null
                && $currentTask->getCustomerId() === $user->getUserId()
                && $currentTask->getStatus() === $currentTask::NEW_TASK);
        }
	}
