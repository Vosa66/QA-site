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
      <li class="nav-item">
        <a class="nav-link" href="SignUp.php">Sign Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="LogIn.php">Log In</a>
      </li>
    </ul>
  </div>
</nav>


<div class="sidenav">
  <p>Pick a question category!</p>
  <a href="Category-loggedout.php?Category=Sport">Sport</a>
  <a href="Category-loggedout.php?Category=Technology">Technology</a>
  <a href="Category-loggedout.php?Category=Art">Art</a>
  <a href="Category-loggedout.php?Category=Games">Games</a>
  <a href="Category-loggedout.php?Category=Pets_Animals">Pets/Animals</a>
  <a href="Category-loggedout.php?Category=Books_Reading">Books/Reading</a>
  <a href="Category-loggedout.php?Category=Medical">Medical</a>
  <a href="Category-loggedout.php?Category=Other">Other</a>
  <a href="Home.php">< Go Back</a>
</div>

<?php 
include_once('config.php');

$category = $_GET['Category'];

$sql = "SELECT * FROM qa_questions WHERE Category=:category";

$get = $connect->prepare($sql);

$get->bindParam(':category', $category);

$get->execute();

$Category = $get->fetchAll();

 ?>

<?php

foreach($Category as $gory){

$user = "SELECT * FROM qa_users WHERE Id=:id ";
  
    $usersel = $connect->prepare($user);
  
    $usersel->bindParam(':id', $gory['Id']);

    $usersel->execute();
      
    $username = $usersel->fetch();




?>

    <div class="text-info ques-div ques-div-design">

    <p class="ques_username"> <?=$username['Username']?> asked: </p>
        
    <a href="Question-loggedout.php?Ques_id=<?=$gory['Ques_id']?>" class="ques">   <?=$gory['Question']?>   </a>

    <form method="POST">

    <input type="hidden" name="question_id" value= <?=$gory['Ques_id']?>>
      
    </form>

    <p class="date-time"> <?php 

      $time = "SELECT * FROM qa_questions WHERE Ques_id = :quesid";

      $timesel = $connect->prepare($time);

      $timesel->bindParam(':quesid', $gory['Ques_id']);

      $timesel->execute();

      $datetime = $timesel->fetch();
    
    ?> 
    
    <?php echo substr($datetime['DateTime'], 0, 16)?>

</p>

    </div>

<?php
}

include('footer.php');

?>
