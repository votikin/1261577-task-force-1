<?php
	require_once 'vendor/autoload.php';

	$task = new App\Task(1);

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
//echo "status = ".$task->getStatus()."<br>";
	// print_r(array_values($task->availableActions(2,"Customer")));
echo "<br>Currrent status = ".$task->getStatus()."<br>Available actions:";
print_r($task->availableActions(1,"Customer"));
//assert($task->getNextStatus(new HtmlAcademy\FailAction()) === $task::FAIL_TASK,'no fail action');
assert($task->getStatus($task->setStatus($task::EXECUTE_TASK)) === $task::EXECUTE_TASK, 'status not ex');

echo "<hr><br>Currrent status = ".$task->getStatus()."<br>Available actions:";
print_r($task->availableActions(1,"Customer"));

echo "<hr><br>Currrent status = ".$task->getStatus()."<br>Available actions:";
$task->setExecutorId(2);
print_r($task->availableActions(1,"Customer"));

echo "<hr><br>Currrent status = ".$task->getStatus()." executor = ".$task->getExecutorId()."<br>Available actions:";
print_r($task->availableActions(2,"Executor"));

echo "<hr><br>Currrent status = ".$task->getStatus()."<br>Available actions:";
print_r($task->availableActions(1,"Customer"));

assert($task->getStatus($task->setStatus($task::FAIL_TASK)) === $task::FAIL_TASK, 'status not ex');
echo "<hr><br>Currrent status = ".$task->getStatus()."<br>Available actions:";
print_r($task->availableActions(1,"Customer"));
