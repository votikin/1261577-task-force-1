<?php
	namespace App\Actions;
    use App\Task;
	/**
	* Класс действия "Отменить"
	*/
	class CancelAction extends AbstractAction
	{
		public const CANCEL_ACTION = "Cancel";

		static public function getPublicName(){
			return self::CANCEL_ACTION;
		}
    static public function getInternalName(){
			return "CANCEL_ACTION";
		}
    static public function isAvailable(Task $currentTask, $userId){
        return (is_null($currentTask->getExecutorId())
                && $currentTask->getCustomerId() === $userId
                && $currentTask->getStatus() === $currentTask::NEW_TASK);
    }
	}
