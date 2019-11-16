<?php
	require_once 'vendor/autoload.php';

	$task = new HtmlAcademy\Task();
	assert($task->getNextStatus($task::CANCEL_ACTION) === $task::CANCEL_TASK,'no cancel action');

	assert($task->getStatus($task->setStatus($task::NEW_TASK)) === $task::NEW_TASK, 'status not new');

	assert($task->getNextStatus($task::RESPONSE_ACTION) === $task::EXECUTE_TASK,'no response action');
	assert($task->getStatus($task->setStatus($task::EXECUTE_TASK)) === $task::EXECUTE_TASK, 'status not ex');

	assert($task->getNextStatus($task::COMPLETE_ACTION) === $task::END_TASK,'no end action');

	assert($task->getStatus($task->setStatus($task::NEW_TASK)) === $task::NEW_TASK, 'status not new');
	assert($task->getNextStatus($task::RESPONSE_ACTION) === $task::EXECUTE_TASK,'no response action');
	assert($task->getStatus($task->setStatus($task::EXECUTE_TASK)) === $task::EXECUTE_TASK, 'status not ex');
	assert($task->getNextStatus($task::FAIL_ACTION) === $task::FAIL_TASK,'no fail action');
