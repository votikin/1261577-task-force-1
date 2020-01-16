<?php
	namespace App\Actions;

	use App\Task;
    use App\User;

	/**
	* Класс действия "На исполнение"
	*/
	class ExecuteAction extends AbstractAction
	{
		public static function getPublicName():string
        {
			return "Выбрать исполнителя";
		}
        public static function getInternalName():string
        {
			return "EXECUTE_ACTION";
		}
        public static function isAvailable(Task $currentTask, User $user):bool
        {
            return (
                $currentTask->getExecutorId() === null
                && $currentTask->getCustomerId() === $user->getUserId()
                && $currentTask->getStatus() === $currentTask::NEW_TASK);
        }
	}
//В будущем надо будет проверять отклики исполнителей, если их нет, то действие невозможно
