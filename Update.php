<?php

    include_once('config.php');

    if(isset($_POST['update'])){

        $firstlastname = $_POST['FirstLastName'];
        $email = $_POST['Email'];
        

        $tempPass = $_POST['Password'];
        $password = password_hash($tempPass, PASSWORD_DEFAULT);

        $Pass = $_POST['ConfPass'];
        $ConfPass = password_hash($Pass, PASSWORD_DEFAULT);

        if(empty($firstlastname) || empty($email) || empty($password) || empty($ConfPass)){
            echo "There are empty fields, please fill them in";
        }else{

            $sql = "SELECT Id FROM qa_users WHERE Username=:username";

            $sqlid = $connect->prepare($sql);

            $sqlid->bindParam(':username',  $_SESSION['Username']);

            $sqlid->execute();

            $id = $sqlid->fetch();
            

            $sql = "UPDATE qa_users SET FirstLastName='$firstlastname', Email='$email', Password='$password', ConfPass='$ConfPass' WHERE Id='$id[Id]'";

            $updateSql = $connect->prepare($sql);

			$updateSql->execute();

			header('Location:LogOut.php');

        }
    }

   

?>