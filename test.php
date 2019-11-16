<?php
	// ini_set("display_errors", 1);
	// error_reporting(E_ERROR | E_WARNING | E_PARSE);
	require_once 'vendor/autoload.php';


	$task = new HtmlAcademy\Task();
	// assert($task->getStatus() === $task::NEW_TASK,'no new status');
	assert($task->getNextStatus($task::CANCEL_ACTION) === $task::CANCEL_TASK,'no cancel action');

	$task1 = new HtmlAcademy\Task();
	assert($task1->getNextStatus($task::RESPONSE_ACTION) == $task::EXECUTE_TASK,'no response action');
	assert($task1->getNextStatus($task::COMPLETE_ACTION) == $task::END_TASK,'no end action');

	$task2 = new HtmlAcademy\Task();
	assert($task2->getNextStatus($task::RESPONSE_ACTION) == $task::EXECUTE_TASK,'no response action');
	assert($task2->getNextStatus($task::FAIL_ACTION) == $task::FAIL_TASK,'no fail action');


// echo $task->getStatus();
