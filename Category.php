<?php 
include_once('config.php');
include('header.php');

$category = $_GET['Category'];

$sql = "SELECT * FROM qa_questions WHERE Category=:category";

$get = $connect->prepare($sql);

$get->bindParam(':category', $category);

$get->execute();

$Category = $get->fetchAll();

foreach($Category as $gory){

  $user = "SELECT * FROM qa_users WHERE Id=:id ";

      $usersel = $connect->prepare($user);

      $usersel->bindParam(':id', $gory['Id']);

      $usersel->execute();

      $username = $usersel->fetch();

 ?>


<div class="sidenav">
  <p>Pick a question category!</p>
  <a href="Category.php?Category=Sport">Sport</a>
  <a href="Category.php?Category=Technology">Technology</a>
  <a href="Category.php?Category=Art">Art</a>
  <a href="Category.php?Category=Games">Games</a>
  <a href="Category.php?Category=Pets_Animals">Pets/Animals</a>
  <a href="Category.php?Category=Books_Reading">Books/Reading</a>
  <a href="Category.php?Category=Medical">Medical</a>
  <a href="Category.php?Category=Other">Other</a>
  <a href="LoggedInHome.php">< Go Back</a>
</div>

<?php

foreach($Category as $gory){




?>

    <div class="text-info ques-div ques-div-design">

    <p class="ques_username"> <?=$username['Username']?> asked: </p>
        
    <a href="Question.php?Ques_id=<?=$gory['Ques_id']?>" class="ques">   <?=$gory['Question']?>   </a>

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
}}

include('footer.php');

?>
