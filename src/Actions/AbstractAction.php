<?php
	namespace App\Actions;
    use App\Task;
	/**
	* Абстрактный класс действия
	*/
	abstract class AbstractAction
	{
		abstract static function getPublicName();
		abstract static function getInternalName();
		abstract static function isAvailable(Task $task, $userId);
	}
