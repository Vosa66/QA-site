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
<a href="Home.php">< Go Back</a>
</div>

<?php

include_once('config.php');

$id = $_GET['Ques_id'];

$sql = "SELECT * FROM qa_questions WHERE Ques_id=$id";

$get = $connect->prepare($sql);

$get->execute();

$question = $get->fetchAll();

foreach($question as $ques){

$usersql = "SELECT * FROM qa_users WHERE Id=:id";

$getuser = $connect->prepare($usersql);

$getuser->bindParam(':id', $ques['Id']);

$getuser->execute();

$username = $getuser->fetchAll();

foreach($username as $user){

?>



<div class=" text-info selected_ques">

<p class="ques_username"><?= $user['Username'] ?> asked:</p>

<h2 class="question"> <?php echo $ques['Question'] ?> </h2>

<form action="Question.php?Ques_id=<?=$id?>" method="POST">
</div>
</form>

</div>

<?php } ?>

<?php

if(!empty($_POST['Comment'])){

    $sql2 = "SELECT Id FROM qa_users WHERE Username=:username";

    $sqlsel = $connect->prepare($sql2);

    $sqlsel->bindParam(':username', $_SESSION['Username']);

    $sqlsel->execute();

    $Id = $sqlsel->fetch();

    $comment = $_POST['Comment'];

    $sql3 = "INSERT INTO qa_comments(Comment, Ques_id, Id) VALUES (:comment, :ques_id, :id)";

    $sqlQuery = $connect->prepare($sql3);

    $sqlQuery->bindParam(':comment', $comment);
    $sqlQuery->bindParam(':ques_id', $id);
    $sqlQuery->bindParam(':id', $Id['Id']);

    $sqlQuery->execute();

}

    $sql4 = "SELECT * FROM qa_comments WHERE Ques_id=$id";

    $sqlselect = $connect->prepare($sql4);

    $sqlselect->execute();

    $Comment = $sqlselect->fetchAll();


    foreach($Comment as $comm){

    $usersql = "SELECT * FROM qa_users WHERE Id=:id";

    $getuser = $connect->prepare($usersql);

    $getuser->bindParam(':id', $comm['Id']);

    $getuser->execute();

    $username = $getuser->fetchAll();

    foreach($username as $user){
    
?>

<div class=" text-info ques-div comm-div">

<p class="ques_username"><?= $user['Username'] ?> answered:</p>
    
    <h4 class="comment"> <?=$comm['Comment']?> </h4>

    <p class="date-time"> <?php 

      $time = "SELECT * FROM qa_comments WHERE Comment_id = :commid";

      $timesel = $connect->prepare($time);

      $timesel->bindParam(':commid', $comm['Comment_id']);

      $timesel->execute();

      $datetime = $timesel->fetch();
    
    ?> 
    
    <?php echo substr($datetime['DateTime'], 0, 16)?>

</div>


    <?php }}} ?>


<?php

include('footer.php');

?>

    </main>