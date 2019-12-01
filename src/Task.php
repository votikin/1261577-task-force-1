<?php
	namespace App;

	use App\User;
	use App\Actions\AbstractAction;
	use App\Actions\ExecuteAction;
    use App\Actions\CancelAction;
    use App\Actions\CompleteAction;
    use App\Actions\FailAction;
    use App\Actions\ResponseAction;
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

        //Пока не понимаю, как пользоваться тем, что возвращает этот  метод. Не понимаю синтаксически.
        private function getAllActions(){
            return [ExecuteAction::class,CancelAction::class,CompleteAction::class,FailAction::class,ResponseAction::class];
        }
        public function availableActions(User $user){

                $availableActs = [];
                if(ExecuteAction::isAvailable($this,$user)){
                    $availableActs[] = ExecuteAction::getPublicName();
                }
                if(CancelAction::isAvailable($this,$user)){
                    $availableActs[] = CancelAction::getPublicName();
                }
                if(CompleteAction::isAvailable($this,$user)){
                    $availableActs[] = CompleteAction::getPublicName();
                }
                if(FailAction::isAvailable($this,$user)){
                    $availableActs[] = FailAction::getPublicName();
                }
                if(ResponseAction::isAvailable($this,$user)){
                    $availableActs[] = ResponseAction::getPublicName();
                }
                return $availableActs;
        }

        public function getAllStatuses(){
			return [self::NEW_TASK,self::EXECUTE_TASK,self::CANCEL_TASK,self::FAIL_TASK,self::END_TASK];
		}

        public function getNextStatus(AbstractAction $currentAction){
				return $this->actionStatusConformity[get_class($currentAction)][$this->currentStatus] ?? null;
		}

		public function getStatus(){
			return $this->currentStatus;
		}
		public function setStatus($status){
			$this->currentStatus = $status;
		}
		public function getExecutorId(){
		    return $this->executorId;
        }
        public function setExecutorId($id){
		    $this->executorId = $id;
        }
        public function getCustomerId(){
		    return $this->customerId;
        }


}
