<?php

namespace taskForce\task\action;


use taskForce\task\domain\Task;
use taskForce\user\domain\User;

/**
 * Абстрактный класс действия
 */
abstract class AbstractAction
{
    abstract static function getPublicName():string ;
    abstract static function getInternalName():string ;
    abstract static function isAvailable(Task $task):bool;
}
