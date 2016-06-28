<?php

require(__DIR__.'/config.php');

//get lots of tasks

$filter = isset($_REQUEST['filter']) ? $_REQUEST['filter'] : null;
$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : null;

$where = '';
if(isset($filter, $value)){
	$where = " WHERE ".$filter." LIKE '".$value."'";
}

$tasks = $db->query("SELECT * FROM tasks ".$where);


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