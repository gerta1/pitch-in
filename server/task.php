<?php

require(__DIR__.'/config.php');

//update or insert a task

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

$title 		 = isset($_POST['title']) ? $_POST['title'] : null;
$description = isset($_POST['description']) ? $_POST['description'] : null;
$board 		 = isset($_POST['board']) ? $_POST['board'] : null;
$team 		 = isset($_POST['team']) ? $_POST['team'] : null;
$category 	 = isset($_POST['category']) ? $_POST['category'] : null;
$labels 	 = isset($_POST['labels']) ? $_POST['labels'] : null;
$users 		 = isset($_POST['users']) ? $_POST['users'] : null;
$clients 	 = isset($_POST['clients']) ? $_POST['clients'] : null;
$open 		 = isset($_POST['open']) ? $_POST['open'] : null;

if(isset($id) && !empty($id)){
	//udpate
	try{	
		$issue = $db->prepare("UPDATE tasks SET board = :board, team = :team, category = :category, title = :title, description = :description, labels = :labels, users = :users, clients = :clients, createdAt = :createdAt, open = :open WHERE id = :id");

		$issue->execute([
			':title' 		=> $title,
			':description' 	=> $description,
			':board' 		=> $board,
			':team' 		=> $team,
			':category' 	=> $category,
			':labels' 		=> $labels,
			':users' 		=> $users,
			':clients' 		=> $clients,
			':createdAt' 	=> time(),
			':open' 		=> $open,
			":id" 			=> $id
		]);
	} catch(Exception $e){
		echo json_encode(['error' => $e]);
		exit;
	}

	$success = "Updated Successfully";
} else {
	//insert

	try{	
		$issue = $db->prepare("INSERT INTO tasks (board, team, category, title, description, labels, users, clients, createdAt, open) VALUES (:board, :team, :category, :title, :description, :labels, :users, :clients, :createdAt, :open)");

		$issue->execute([
			':title' 		=> $title,
			':description' 	=> $description,
			':board' 		=> $board,
			':team' 		=> $team,
			':category' 	=> $category,
			':labels' 		=> $labels,
			':users' 		=> $users,
			':clients' 		=> $clients,
			':createdAt' 	=> time(),
			':open' 		=> 1
		]);
	} catch(Exception $e){
		echo json_encode(['error' => $e]);
		exit;
	}

	$success = "Added Successfully";
}

echo json_encode(['success' => $success, 'data' => '']);
