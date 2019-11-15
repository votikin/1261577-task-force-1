<?php 
	namespace HtmlAcademy;
	/**
	* Класс задания
	*/
	class Task
	{
		//константы стаутсов
		const NEW_TASK = "Новое";
		const EXECUTE_TASK = "Выполняется";
		const CANCEL_TASK = "Отменено";
		const FAIL_TASK = "Провалено";		
		const END_TASK = "Завершено";		

		//константы экшенов
		const CANCEL_ACTION = "Отменить";
		const COMPLETE_ACTION = "Одобрить";
		const RESPONSE_ACTION = "Откликнуться";
		const FAIL_ACTION = "Отказаться";


		private $currentStatus;
		private $currentAction;

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
			switch ($action) {
				case self::CANCEL_ACTION:
					$this->currentStatus = self::CANCEL_TASK;
					break;
				case self::COMPLETE_ACTION:
					$this->currentStatus = self::END_TASK;
					break;
				case self::RESPONSE_ACTION:
					$this->currentStatus = self::EXECUTE_TASK;
					break;
				case self::FAIL_ACTION:
					$this->currentStatus = self::FAIL_TASK;
					break;	
				default:
					$this->currentStatus = null;
					break;
			}
			$this->currentAction = $action;
			return $this->currentStatus;
		}
		
		public function getStatus(){
			return $this->currentStatus;
		}

		public function getAction(){
			return $this->currentAction;
		}
	}