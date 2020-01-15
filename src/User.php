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

        function __construct(int $userId)
        {
            $this->userId = $userId;
            $this->userRole = self::CUSTOMER_ROLE;
        }

        public function getUserId():int
        {
            return $this->userId;
        }

        public function setUserId(int $userId)
        {
            $this->userId = $userId;
        }
        public function getUserRole():string
        {
            return $this->userRole;
        }
        public function changeRoleToExecutor():void
        {
            $this->userRole = self::EXECUTOR_ROLE;
            //В будущем надо будет приватно проверять, есть ли у юзера специализации, и тогда менять роль,если нет - кинуть исключение
        }
    }
