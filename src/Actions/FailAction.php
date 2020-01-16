<?php
    namespace App\Actions;

    use App\Task;
    use App\User;

	/**
	* Класс действия "Отказаться"
	*/
	class FailAction extends AbstractAction
	{
        public static function getPublicName():string
        {
                return "Отказаться";
        }
        public static function getInternalName():string
        {
                return "FAIL_ACTION";
        }
        public static function isAvailable(Task $currentTask, User $user):bool
        {
            return (
                $currentTask->getExecutorId() === $user->getUserId()
                && $currentTask->getCustomerId() !== $user->getUserId()
                && $currentTask->getStatus() === $currentTask::EXECUTE_TASK);
        }
	}
