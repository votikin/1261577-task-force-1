<?php
		namespace App\Actions;
        use App\Task;
	/**
	* Класс действия "Откликнуться"
	*/
	class ResponseAction extends AbstractAction
	{
		public const RESPONSE_ACTION = "Response";

    static public function getPublicName(){
			return self::RESPONSE_ACTION;
		}
    static public function getInternalName(){
			return "RESPONSE_ACTION";
		}
    static public function isAvailable(Task $currentTask, $userId){
             return is_null($currentTask->getExecutorId()
                            && $currentTask->getStatus() === $currentTask::NEW_TASK);
    }
	}
