<?php

require(__DIR__.'/config.php');

$tasks = $db->query("SELECT * FROM tasks");


$open = [];
$closed = [];

foreach($tasks as $task){
	if($task['open'] == 1){
		$open[] = $task;
	} else {
		$closed[] = $task;
	}
}

echo json_encode([
	'open' => $open,
	'closed' => $closed
]);