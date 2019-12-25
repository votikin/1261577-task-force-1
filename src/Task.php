<?php
	namespace App;

	use App\Actions\AbstractAction;
	use App\Actions\ExecuteAction;
    use App\Actions\CancelAction;
    use App\Actions\CompleteAction;
    use App\Actions\FailAction;
    use App\Actions\ResponseAction;
    use App\Exceptions\UserException;
	/**
	* Класс задания
	*/
	class Task
	{
		//statuses
		public const NEW_TASK = "New";
		public const EXECUTE_TASK = "Execute";
		public const CANCEL_TASK = "Canceled";
		public const FAIL_TASK = "Failed";
		public const END_TASK = "Completed";

        private $executorId; // исполнитель
        private $customerId; // заказчик
	    private $currentStatus;

		private $actionStatusConformity = [
			CancelAction::class => [self::NEW_TASK => self::CANCEL_TASK],
			ExecuteAction::class => [self::NEW_TASK => self::EXECUTE_TASK],
            ResponseAction::class => [self::NEW_TASK => self::NEW_TASK], //здесь статус не меняется, но как-то надо учитывать отклики
            CompleteAction::class => [self::EXECUTE_TASK => self::END_TASK],
            FailAction::class => [self::EXECUTE_TASK => self::FAIL_TASK]
		];

        function __construct(User $user)
        {
            $this->currentStatus = self::NEW_TASK;
            $this->customerId = $user->getUserId();
        }

        private function getAllActions(){
            return [ExecuteAction::class,CancelAction::class,CompleteAction::class,FailAction::class,ResponseAction::class];
        }
        public function availableActions(User $user):array {
                $availableActs = [];
                foreach ($this->getAllActions() as $class) {
                    if($class::isAvailable($this,$user)){
                        $availableActs[] = $class::getPublicName();
                    }
                }
                return $availableActs;
        }

        public function getAllStatuses():array {
			return [self::NEW_TASK,self::EXECUTE_TASK,self::CANCEL_TASK,self::FAIL_TASK,self::END_TASK];
		}

        public function getNextStatus(AbstractAction $currentAction):?string {
				return $this->actionStatusConformity[get_class($currentAction)][$this->currentStatus] ?? null;
		}

		public function getStatus():string {
			return $this->currentStatus;
		}
		public function setStatus(string $status){
            if($status === self::EXECUTE_TASK && $this->executorId === null){
                throw new UserException("Need choose executor for this task");
            }
            if($status === self::NEW_TASK && $this->executorId !== null){
                throw new UserException("This task just has executor");
            }
			$this->currentStatus = $status;
		}
		public function getExecutorId():?int{
		    return $this->executorId;
        }
        public function setExecutorId(int $id):void{
		    $this->executorId = $id;
        }
        public function getCustomerId():int {
		    return $this->customerId;
        }
        public function resetExecutorId():void{
            $this->executorId = NULL;
        }


}
