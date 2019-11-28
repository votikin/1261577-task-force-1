<?php
	namespace App\Actions;
	use App\Task;
	/**
	* Класс действия "На исполнение"
	*/
	class ExecuteAction extends AbstractAction
	{
		public const EXECUTE_ACTION = "Execute";

		static public function getPublicName(){
			return self::EXECUTE_ACTION;
		}
        static public function getInternalName(){
			return "EXECUTE_ACTION";
		}
        static public function isAvailable(Task $currentTask, $userId){
            return (is_null($currentTask->getExecutorId())
                    && $currentTask->getCustomerId() === $userId
                    && $currentTask->getStatus() === $currentTask::NEW_TASK);
    }
	}
