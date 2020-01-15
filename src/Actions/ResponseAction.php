<?php
	namespace App\Actions;

	use App\Task;
    use App\User;

	/**
	* Класс действия "Откликнуться"
	*/
	class ResponseAction extends AbstractAction
	{
        public static function getPublicName():string
        {
            return "Откликнуться";
		}
		public static function getInternalName():string
        {
			return "RESPONSE_ACTION";
		}
		public static function isAvailable(Task $currentTask, User $user):bool
        {
            return (
                $currentTask->getExecutorId() === null
                && $currentTask->getStatus() === $currentTask::NEW_TASK
                && $currentTask->getCustomerId() !== $user->getUserId()
                && $user->getUserRole() !== $user::CUSTOMER_ROLE); //Только при условии, что юзер не может быть одновременно исполнителем и заказчиком
         }
	}
