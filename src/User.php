<?php
    namespace App;

    /**
     * Класс Пользователя
    */
    class User
    {
        //Roles
        public const EXECUTOR_ROLE = "Executor";
        public const CUSTOMER_ROLE = "Customer";

        private $userId;
        private $userRole;

        function __construct($userId)
        {
            $this->userId = $userId;
            $this->userRole = self::CUSTOMER_ROLE;
        }

        public function getUserId() {
            return $this->userId;
        }

        public function getUserRole() {
            return $this->userRole;
        }
        public function changeRoleToExecutor(){
            $this->userRole = self::EXECUTOR_ROLE;
            //В будущем надо будет приватно проверять, есть ли у юзера специализации, и тогда менять роль
        }
    }
