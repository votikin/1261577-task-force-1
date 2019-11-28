<?php
	namespace App;
	use \App\Actions\ExecuteAction;
    use \App\Actions\CancelAction;
    use \App\Actions\CompleteAction;
    use \App\Actions\FailAction;
    use \App\Actions\ResponseAction;
	/**
	* Класс задания
	*/
	class Task
	{
		//Roles
		public const EXECUTOR_ROLE = "Executor";
		public const CUSTOMER_ROLE = "Customer";
		//statuses
		public const NEW_TASK = "New";
		public const EXECUTE_TASK = "Execute";
		public const CANCEL_TASK = "Canceled";
		public const FAIL_TASK = "Failed";
		public const END_TASK = "Completed";

		// //actions
		// public const CANCEL_ACTION = "Cancel";
		// public const COMPLETE_ACTION = "Complete"; //Одобрить
		// public const RESPONSE_ACTION = "Response"; //Откликнуться
		// public const FAIL_ACTION = "Fail";

        private $executorId = null; // исполнитель
        private $customerId;    // заказчик
	    private $currentStatus;

		private $actionStatusConformity = [
			"CANCEL_ACTION" => [self::NEW_TASK => self::CANCEL_TASK],
			"EXECUTE_ACTION" => [self::NEW_TASK => self::EXECUTE_TASK],
			"RESPONSE_ACTION" => [self::NEW_TASK => self::NEW_TASK], //здесь статус не меняется, но как-то надо учитывать отклики
			"COMPLETE_ACTION" => [self::EXECUTE_TASK => self::END_TASK],
			"FAIL_ACTION" => [self::EXECUTE_TASK => self::FAIL_TASK]
		];

        public function availableActions($userId,$userRole){

                $availableActs = [];
                if(ExecuteAction::isAvailable($this,$userId)){
                    $availableActs[] = ExecuteAction::getPublicName();
                }
                if(CancelAction::isAvailable($this,$userId)){
                    $availableActs[] = CancelAction::getPublicName();
                }
                if(CompleteAction::isAvailable($this,$userId)){
                    $availableActs[] = CompleteAction::getPublicName();
                }
                if(FailAction::isAvailable($this,$userId)){
                    $availableActs[] = FailAction::getPublicName();
                }
                if(ResponseAction::isAvailable($this,$userId)){
                    $availableActs[] = ResponseAction::getPublicName();
                }
                return $availableActs;
        }

        function __construct($customerId)
		{
			$this->currentStatus = self::NEW_TASK;
			$this->customerId = $customerId;
		}

        public function getAllStatuses(){
			return [self::NEW_TASK,self::EXECUTE_TASK,self::CANCEL_TASK,self::FAIL_TASK,self::END_TASK];
		}

        public function getNextStatus(AbstractAction $currentAction){
				return $this->actionStatusConformity[$currentAction::getInternalName()][$this->currentStatus] ?? null;
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
