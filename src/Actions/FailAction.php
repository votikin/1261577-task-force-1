<?php
    namespace App\Actions;

    use App\Task;
    use App\User;
	/**
	* Класс действия "Отказаться"
	*/
	class FailAction extends AbstractAction
	{
        static public function getPublicName(){
                return "Отказаться";
        }
        static public function getInternalName(){
                return "FAIL_ACTION";
        }
        static public function isAvailable(Task $currentTask, User $user){
            return ($currentTask->getExecutorId() === $user->getUserId()
                && $currentTask->getCustomerId() !== $user->getUserId()
                && $currentTask->getStatus() === $currentTask::EXECUTE_TASK);
        }
	}
