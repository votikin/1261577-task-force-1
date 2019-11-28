<?php
		namespace App\Actions;
        use App\Task;
	/**
	* Класс действия "Завершить"
	*/
	class CompleteAction extends AbstractAction
	{
		public const COMPLETE_ACTION = "Complete";

    static public function getPublicName(){
			return self::COMPLETE_ACTION;
		}
    static public function getInternalName(){
			return "COMPLETE_ACTION";
		}
    static public function isAvailable(Task $currentTask, $userId){
        return (!is_null($currentTask->getExecutorId())
                && $currentTask->getCustomerId() === $userId
                && $currentTask->getStatus() === $currentTask::EXECUTE_TASK);
    }
	}
