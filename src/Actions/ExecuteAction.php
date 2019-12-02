<?php
	namespace App\Actions;

	use App\Task;
    use App\User;
	/**
	* Класс действия "На исполнение"
	*/
	class ExecuteAction extends AbstractAction
	{
		static public function getPublicName(){
			return "Выбрать исполнителя";
		}
        static public function getInternalName(){
			return "EXECUTE_ACTION";
		}
        static public function isAvailable(Task $currentTask, User $user){
            return ($currentTask->getExecutorId() === null
                    && $currentTask->getCustomerId() === $user->getUserId()
                    && $currentTask->getStatus() === $currentTask::NEW_TASK);
    }
	}
//В будущем надо будет проверять отклики исполнителей, если их нет, то действие невозможно
