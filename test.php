<?php
// ini_set('assert.exception', '1');
// ini_set('zend.assertions','0');
 declare(strict_types=1);
 use App\Actions\CancelAction;
 use App\Actions\CompleteAction;
 use App\Actions\ExecuteAction;
 use App\Actions\FailAction;
 use App\Actions\ResponseAction;

 require_once 'vendor/autoload.php';

    $user = new \App\User(1);
    $userExecutor = new \App\User(2);
    $userExecutor->changeRoleToExecutor();
    try{
    	$task = new App\Task($user);
    } catch (\App\Exceptions\UserException $e){
	    error_log($e->getStructMessage());
    }

//Пишем тесты
 //роль = заказчик
    // Статус = new
    assert($task->availableActions($user) === [ExecuteAction::getPublicName(),CancelAction::getPublicName()],"\"not valid actions for new status and customer role\"");

    // Статус = Execute
    $task->setExecutorId(2);
    try{
        $task->setStatus($task::EXECUTE_TASK);
    } catch(\App\Exceptions\UserException $e){
        echo ($e->getStructMessage()."<b>catch in:</b> ".__FILE__." on line <b>".__LINE__."</b><br>");
    }
    assert($task->availableActions($user) === [CompleteAction::getPublicName()],"\"not valid actions for Execute status and customer role\"");

    // Статус = Canceled
    $task->setStatus($task::CANCEL_TASK);
    assert($task->availableActions($user) === [],"\"not valid actions for Canceled status and customer role\"");

    // Статус = Failed
    $task->setStatus($task::FAIL_TASK);
    assert($task->availableActions($user) === [],"\"not valid actions for Failed status and customer role\"");

    // Статус = Completed
    $task->setStatus($task::END_TASK);
    assert($task->availableActions($user) === [],"\"not valid actions for Completed status and customer role\"");

 //роль = исполнитель
    // Статус = New
    $task->resetExecutorId();
    try{
        $task->setStatus($task::NEW_TASK);
    } catch(\App\Exceptions\UserException $e){
        echo ($e->getStructMessage()."<b>catch in:</b> ".__FILE__." on line <b>".__LINE__."</b><br>");
    }
    assert($task->availableActions($userExecutor) === [ResponseAction::getPublicName()],"\"not valid actions for new status and executor role\"");

    // Статус = Execute
    $task->setExecutorId(2);
    try{
        $task->setStatus($task::EXECUTE_TASK);
    } catch(\App\Exceptions\UserException $e){
        echo ($e->getStructMessage()."<b>catch in:</b> ".__FILE__." on line <b>".__LINE__."</b><br>");
    }
    assert($task->availableActions($userExecutor) === [FailAction::getPublicName()],"\"not valid actions for Execute status and customer role\"");

    // Статус = Canceled
    $task->setStatus($task::CANCEL_TASK);
    assert($task->availableActions($userExecutor) === [],"\"not valid actions for Canceled status and customer role\"");

    // Статус = Failed
    $task->setStatus($task::FAIL_TASK);
    assert($task->availableActions($userExecutor) === [],"\"not valid actions for Failed status and customer role\"");

    // Статус = Completed
    $task->setStatus($task::END_TASK);
    assert($task->availableActions($userExecutor) === [],"\"not valid actions for Completed status and customer role\"");
