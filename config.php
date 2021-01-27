<?php 

    session_start();


	$server = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'q_a';

	try {
		
		$connect = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);


	} catch (Exception $e) {
		
		echo "Not inserted";
	}


 ?>