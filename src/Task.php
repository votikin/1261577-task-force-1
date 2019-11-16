<?php 
	namespace HtmlAcademy;
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

		//actions
		public const CANCEL_ACTION = "Cancel";
		public const COMPLETE_ACTION = "Complete"; //Одобрить
		public const RESPONSE_ACTION = "Response"; //Откликнуться
		public const FAIL_ACTION = "Fail";

		private $currentStatus;
		private $actionStatusConformity = [
			self::CANCEL_ACTION => [self::NEW_TASK => self::CANCEL_TASK],
			self::RESPONSE_ACTION => [self::NEW_TASK => self::EXECUTE_TASK],
			self::COMPLETE_ACTION => [self::EXECUTE_TASK => self::END_TASK],
			self::FAIL_ACTION => [self::EXECUTE_TASK => self::FAIL_TASK]
		];

		function __construct()
		{
			$this->currentStatus = self::NEW_TASK;
		}

		public function getAllActions(){
			return [self::CANCEL_ACTION,self::COMPLETE_ACTION,self::RESPONSE_ACTION,self::FAIL_ACTION];
		}

		public function getAllStatuses(){
			return [self::NEW_TASK,self::EXECUTE_TASK,self::CANCEL_TASK,self::FAIL_TASK,self::END_TASK];
		}

		public function getNextStatus($action){
			return $this->actionStatusConformity[$action][$this->currentStatus] ?? null;
		}
		
		public function getStatus(){
			return $this->currentStatus;
		}
		public function setStatus($status){
			$this->currentStatus = $status;
		}
}