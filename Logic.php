<DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mycss.css">
    <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>

</head>

<body>

<div class="password-doesnt-match">

<?php

    require("config.php");

    if(isset($_POST['submit'])){
        
        $username = $_POST['Username'];
        $password = $_POST['Password'];

        if(empty($username) || empty($password)){
            echo "Fill in all fields!";
        }
        else{
            $sql = "SELECT Username, FirstLastName, Email, Password, ConfPass FROM qa_users WHERE username=:username";

            $insertsql = $connect->prepare($sql);

            $insertsql->bindParam(':username', $username);

            $insertsql->execute();

            $data = $insertsql->fetch();

            if($data == false)
            {
                echo "Username $username not found";
            }
            else
            {
                $Pass = $_POST['Password'];
               
                
                if(password_verify($Pass, $data['Password'])){

                    $_SESSION['Username'] = $data['Username'];
                    $_SESSION['FirstLastName'] = $data['FirstLastName'];
                    $_SESSION['Email'] = $data['Email'];
                    $_SESSION['Password'] = $data['Password'];

                    header('Location:LoggedInHome.php');

                }else{
                    echo "Password doesn't match username.";
                }

            }
        }


    }

?>
<br>
<br>
<a href="LogIn.php">Go Back!</a>

</div>

</body>

</html>