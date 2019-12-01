<?php
    namespace App\Actions;

    use App\Task;
    use App\User;
	/**
	* Класс действия "Завершить"
	*/
	class CompleteAction extends AbstractAction
	{
        static public function getPublicName(){
		    return "Одобрить";
	    }
        static public function getInternalName(){
		    return "COMPLETE_ACTION";
        }
        static public function isAvailable(Task $currentTask, User $user){
            return ($currentTask->getExecutorId() !== null
                && $currentTask->getCustomerId() === $user->getUserId()
                && $currentTask->getStatus() === $currentTask::EXECUTE_TASK);
        }
	}
