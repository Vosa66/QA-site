<?php

include_once("config.php");

if(isset($_POST['submit']))
	{

		$username = $_POST['Username'];
		$FirstLastName = $_POST['FirstLastName'];
		$email = $_POST['Email'];
        
        
        
        $Pass = $_POST['Password'];
        $password = password_hash($Pass, PASSWORD_DEFAULT);

        $Confirm = $_POST['ConfPass'];
        $confirm_password = password_hash($Confirm, PASSWORD_DEFAULT);

		if(empty($username) || empty($FirstLastName) || empty($email) || empty($password) || empty($confirm_password))
		{
			echo "Please enter all the information!";
		}
		else
		{

			$sql = "INSERT INTO qa_users(Username,FirstLastName,Email,Password,ConfPass) VALUES (:Username, :FirstLastName, :Email, :Password, :ConfPass)";

			$sqlQuery = $connect->prepare($sql);

			$sqlQuery->bindParam(':Username', $username);
			$sqlQuery->bindParam(':FirstLastName', $FirstLastName);
			$sqlQuery->bindParam(':Email', $email);
            $sqlQuery->bindParam(':Password', $password);
            $sqlQuery->bindParam(':ConfPass', $confirm_password);

            $sqlQuery->execute();
            
            echo "Data inserted";

			header('Location:LogIn.php');
            

		}

	}

?>