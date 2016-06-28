<?php

require(__DIR__.'/config.php');

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

if(!isset($id)){
	echo json_encode(['error' => 'No id']);
	exit;
}

$task = $db->prepare("SELECT * FROM tasks WHERE id = :id");

$task->execute([':id' => $id]);

echo json_encode($task->fetch(PDO::FETCH_ASSOC));

