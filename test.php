<?php
	require_once 'vendor/autoload.php';

    $user = new \App\User(1);
    $userExecutor = new \App\User(2);
    $task = new App\Task($user);

	// assert($task->getNextStatus(new HtmlAcademy\CancelAction()) === $task::CANCEL_TASK,'no cancel action');
	// assert($task->getStatus($task->setStatus($task::NEW_TASK)) === $task::NEW_TASK, 'status not new');
	// assert($task->getNextStatus(new HtmlAcademy\ExecuteAction()) === $task::EXECUTE_TASK,'no response action');
	// assert($task->getStatus($task->setStatus($task::EXECUTE_TASK)) === $task::EXECUTE_TASK, 'status not ex');
	// assert($task->getNextStatus(new HtmlAcademy\CompleteAction()) === $task::END_TASK,'no end action');
	// assert($task->getStatus($task->setStatus($task::NEW_TASK)) === $task::NEW_TASK, 'status not new');
	// assert($task->getNextStatus(new HtmlAcademy\ExecuteAction()) === $task::EXECUTE_TASK,'no response action');
	// assert($task->getStatus($task->setStatus($task::EXECUTE_TASK)) === $task::EXECUTE_TASK, 'status not ex');
	// assert($task->getNextStatus(new HtmlAcademy\FailAction()) === $task::FAIL_TASK,'no fail action');
	// assert($task->getStatus($task->setStatus($task::NEW_TASK)) === $task::NEW_TASK, 'status not new');
	// print_r(array_values($task->availableActions(2,"Customer")));


echo "<br>1Currrent status = ".$task->getStatus()." | role=".$user->getUserRole()."<br>Available actions:";
print_r($task->availableActions($user));

echo "<hr><br>2Currrent status = ".$task->getStatus()." | role=".$userExecutor->getUserRole()."<br>Available actions:";
print_r($task->availableActions($userExecutor));

$userExecutor->changeRoleToExecutor();
echo "<hr><br>3Currrent status = ".$task->getStatus()." | role=".$userExecutor->getUserRole()."<br>Available actions:";
print_r($task->availableActions($userExecutor));

assert($task->getStatus($task->setStatus($task::EXECUTE_TASK)) === $task::EXECUTE_TASK, 'status not ex');

echo "<hr><br>4Currrent status = ".$task->getStatus()." | role=".$user->getUserRole()."<br>Available actions:";
print_r($task->availableActions($user));

echo "<hr><br>5Currrent status = ".$task->getStatus()." | role=".$user->getUserRole()."<br>Available actions:";
$task->setExecutorId(2);
print_r($task->availableActions($user));

echo "<hr><br>7Currrent status = ".$task->getStatus()." | role=".$userExecutor->getUserRole()."<br>Available actions:";
print_r($task->availableActions($userExecutor));

assert($task->getStatus($task->setStatus($task::FAIL_TASK)) === $task::FAIL_TASK, 'status not ex');
echo "<hr><br>Currrent status = ".$task->getStatus()." | role=".$user->getUserRole()."<br>Available actions:";
print_r($task->availableActions($user));

