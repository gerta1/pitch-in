<?php

require(__DIR__.'/config.php');

$issue = $db->prepare("INSERT INTO tasks (board, category, title, description, labels, users, clients, createdAt) VALUES (:board, :category, :title, :description, :labels, :users, :clients, :createdAt)");

$issue->execute([
	':title' => $_POST['title'],
	':description' => $_POST['description'],
	':board' => $_POST['board'], 
	':category' => $_POST['category'], 
	':labels' => $_POST['labels'], 
	':users' => $_POST['users'], 
	':clients' => $_POST['clients'],
	':createdAt' => time()
]);