<?php

$db = new PDO('mysql:host=127.0.0.1;dbname=pitchin;port=3306;charset=utf8mb4', 'root', 'password',
	[PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);