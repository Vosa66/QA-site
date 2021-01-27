<?php

include_once('config.php');
include('header.php');

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


<div class="sidenav">
<a href="LoggedInHome.php">< Go Back</a>
</div>

<div class="text-info selected_ques">

<p class="ques_username"><?= $user['Username'] ?> asked:</p>

<h2 class="question"> <?php echo $ques['Question'] ?> </h2>

<form action="Question.php?Ques_id=<?=$id?>" method="POST">
<div class="input-group mb-3">
<input type="text" name="Comment" placeholder="Answer.." class="comm_input question">
<div class="input-group-append">
    <button type="submit" name="answer" class="btn btn-outline-secondary" type="button" id="button-addon2">Answer!</button>
</div>
</div>
</form>

</div>

<?php } ?>

<?php

$time = date('Y-m-d H:i');

if(!empty($_POST['Comment'])){

    $sql2 = "SELECT Id FROM qa_users WHERE Username=:username";

    $sqlsel = $connect->prepare($sql2);

    $sqlsel->bindParam(':username', $_SESSION['Username']);

    $sqlsel->execute();

    $Id = $sqlsel->fetch();

    $comment = $_POST['Comment'];

    $sql3 = "INSERT INTO qa_comments(Comment, Ques_id, Id, DateTime) VALUES (:comment, :ques_id, :id, :datetime)";

    $sqlQuery = $connect->prepare($sql3);

    $sqlQuery->bindParam(':comment', $comment);
    $sqlQuery->bindParam(':ques_id', $id);
    $sqlQuery->bindParam(':id', $Id['Id']);
    $sqlQuery->bindParam(':datetime', $time );

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
  
    </p>

</div>


    <?php } 
        }}
    ?>


<?php

include('footer.php');

?>

    </main>