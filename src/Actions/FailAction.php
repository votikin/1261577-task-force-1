<?php
		namespace App\Actions;
        use App\Task;
	/**
	* Класс действия "Отказаться"
	*/
	class FailAction extends AbstractAction
	{
		public const FAIL_ACTION = "Fail";

    static public function getPublicName(){
			return self::FAIL_ACTION;
		}
    static public function getInternalName(){
			return "FAIL_ACTION";
		}
    static public function isAvailable(Task $currentTask, $userId){
        return ($currentTask->getExecutorId() === $userId
                && $currentTask->getCustomerId() !== $userId
                && $currentTask->getStatus() === $currentTask::EXECUTE_TASK);
    }
	}
