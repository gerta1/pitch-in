<?php

require(__DIR__.'/config.php');

// print_r($_POST);

$columnString = '';
$valueString = '';
$executeArray = [];

foreach($_POST as $key => $val){
	$val = isset($val) ? $val : null;
	$columnString .= $key.', ';
	$valueString  .= ':'.$key.', ';
	$executeArray[':'.$key] = $val;
}

$columnString = rtrim($columnString, ", ");
$valueString = rtrim($valueString, ", ");

$query = "INSERT INTO client (".$columnString.") VALUES (".$valueString.")";


try{
	$newClient = $db->prepare($query);
	$newClient->execute($executeArray);
} catch(Exception $e){
	print_r(json_encode($e));
	exit;
}


if($result){
	//done
	print_r(json_encode(['data' => [$executeArray]]));
} else {
	//error
	print_r(json_encode(['error' => "unexpected error"]));
	exit;
}