<?php

include_once('config.php');

?>


<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mycss.css">
    <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>

</head>
<body class="body">

<main class="main">

<div class="image"><img src="question-mark.jpg" width="100%" height="210px"></div>

<nav class="navbar navbar-expand-lg navbar-light navbar-colour">
  <a class="navbar-brand Q-A" href="#">Q-A</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="Home.php">Home</a>
      </li>
    </ul>
  </div>
</nav>

<div class="sidenav">
  <p></p>
</div>


<div class="container">
    <div class="row">
        <div class="form_bg signup">
            <form action="Register.php" method="POST">
                 <h2 class="text-center">Sign Up!</h2>
                <br/>
                <div class="form-group">
                    <input type="text" name="Username" class="form-control" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="text" name="FirstLastName" class="form-control" id="pwd" placeholder="Full Name">
                </div>
                <div class="form-group">
                    <input type="email" name="Email" class="form-control" id="pwd" placeholder="E-mail">
                </div>
                <div class="form-group">
                    <input type="password" name="Password" class="form-control" id="pwd" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="password" name="ConfPass" class="form-control" id="pwd" placeholder="Confirm Password">
                </div>
                <br/>
                <div class="align-center">
                    <button type="submit" name="submit" class="btn btn-default" id="login">SignUp</button>
                </div>
                <p class="align-center">Already have an account? <a href="LogIn.php">Log In!</a></p>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

