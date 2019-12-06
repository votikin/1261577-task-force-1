<?php
	namespace App\Actions;

    use App\Task;
    use App\User;
	/**
	* Абстрактный класс действия
	*/
	abstract class AbstractAction
	{
		abstract static function getPublicName():string ;
		abstract static function getInternalName():string ;
		abstract static function isAvailable(Task $task, User $user):bool;
	}
