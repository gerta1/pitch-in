<?php

require(__DIR__.'/config.php');

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

if(isset($id)){
	//udpate
	try{	
		$issue = $db->prepare("UPDATE tasks SET board = :board, category = :category, title = :title, description = :description, labels = :labels, users = :users, clients = :clients, createdAt = :createdAt, open = :open WHERE id = :id");

		$issue->execute([
			':title' => $_POST['title'],
			':description' => $_POST['description'],
			':board' => $_POST['board'], 
			':category' => $_POST['category'], 
			':labels' => $_POST['labels'], 
			':users' => $_POST['users'], 
			':clients' => $_POST['clients'],
			':createdAt' => time(),
			':open' => $_POST['open'],
			":id" => $id
		]);
	} catch(Exception $e){
		echo json_encode(['error' => $e]);
	}
} else {
	//insert

	try{	
		$issue = $db->prepare("INSERT INTO tasks (board, category, title, description, labels, users, clients, createdAt, open) VALUES (:board, :category, :title, :description, :labels, :users, :clients, :createdAt, :open)");

		$issue->execute([
			':title' => $_POST['title'],
			':description' => $_POST['description'],
			':board' => $_POST['board'], 
			':category' => $_POST['category'], 
			':labels' => $_POST['labels'], 
			':users' => $_POST['users'], 
			':clients' => $_POST['clients'],
			':createdAt' => time(),
			':open' => 1
		]);
	} catch(Exception $e){
		echo json_encode(['error' => $e]);
	}
}