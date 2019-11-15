<?php
	require_once 'bootstrap.php';

	$task = new HtmlAcademy\Task();
	assert($task->getStatus() == $task::NEW_TASK,'no new status action');

	assert($task->getNextStatus($task::CANCEL_ACTION) == $task::CANCEL_TASK,'no cancel action');
	assert($task->getNextStatus($task::COMPLETE_ACTION) == $task::END_TASK,'no end action');
	assert($task->getNextStatus($task::RESPONSE_ACTION) == $task::EXECUTE_TASK,'no response action');
	assert($task->getNextStatus($task::FAIL_ACTION) == $task::FAIL_TASK,'no fail action');

echo $task->getStatus();
