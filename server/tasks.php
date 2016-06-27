<?php

require(__DIR__.'/config.php');

$tasks = $db->query("SELECT * FROM tasks WHERE open = 1");

echo json_encode([
	'open' => $tasks->fetchAll(PDO::FETCH_ASSOC)
]);