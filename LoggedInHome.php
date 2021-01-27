<?php 
include_once('config.php');
include('header.php');
if(empty($_SESSION['Username'])){
  header('Location: LogIn.php');
}
 ?>


<div class="question-form">

<form method="POST">
<h5 class="what-ques">What is your question?</h5>
<div class="input-group mb-3 ques_input">
  <input type="text" class="form-control question question_input" name="Question" placeholder="Ask a Question!" aria-label="Ask a Question!" aria-describedby="button-addon2" required>
  
</div>

<div class="category-check">

  <h5 class="what-gory">What category is your question?</h5>

  <select name="Category" class="category_select">
    <option value="Sport">Sport</option>
    <option value="Technology">Technology</option>
    <option value="Art">Art</option>
    <option value="Games">Games</option>
    <option value="Pets_Animals">Pets/Animals</option>
    <option value="Books_Reading">Books/Reading</option>
    <option value="Medical">Medical</option>
    <option value="Other">Other</option>
  </select>

</div>
<div class="input-group-append">
    <button type="submit" name="ask" class="btn btn-outline-secondary ask-button" type="button" id="button-addon2">Ask!</button>
  </div>
</form>

</div>

<?php

include('footer.php');

if(!empty($_POST['Question'])){

    $question = $_POST['Question'];

    $selected_val = $_POST['Category'];

    $sql = "SELECT Id FROM qa_users WHERE Username=:username";

    $sqlsel = $connect->prepare($sql);

    $sqlsel->bindParam(':username', $_SESSION['Username']);

    $sqlsel->execute();

    $id = $sqlsel->fetch();

    $sql = "INSERT INTO qa_questions(Id, Question, Category, DateTime) VALUES (:Id, :Question, :Category, :DateTime)";

		$sqlQuery = $connect->prepare($sql);

    $sqlQuery->bindParam(':Question', $question);
    $sqlQuery->bindParam(':Id', $id['Id']);
    $sqlQuery->bindParam(':Category', $selected_val);
    $sqlQuery->bindParam(':DateTime', date('Y-m-d H:i'));

    $sqlQuery->execute();

  header('Location:LoggedInHome.php');

         
}

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
</div>

<div>

  <?php
    $sql = "SELECT * FROM qa_questions";
    $getquestions = $connect->prepare($sql);
    $getquestions->execute();
    $questions = $getquestions->fetchAll();
  ?>

  <?php
    foreach($questions as $question){

  ?>

  
   <div class="text-info ques-div ques-div-design">

   <?php

      $user = "SELECT * FROM qa_users WHERE Id=:id ";

      $usersel = $connect->prepare($user);

      $usersel->bindParam(':id', $question['Id']);

      $usersel->execute();

      $username = $usersel->fetch();
   
   ?>

  <p class="ques_username">   <?=$username['Username']?> asked:    </p>
   
   <a href="Question.php?Ques_id=<?=$question['Ques_id']?>" class="ques">   <?=$question['Question']?>   </a>

    <form method="POST">

    <input type="hidden" name="question_id" value= <?=$question['Ques_id']?>>
    <input type="hidden" name="user_id" value= <?=$question['Id']?>>
      
    </form>

    <p class="date-time"> <?php

      $time = "SELECT * FROM qa_questions WHERE Ques_id = :quesid";

      $timesel = $connect->prepare($time);

      $timesel->bindParam(':quesid', $question['Ques_id']);

      $timesel->execute();

      $datetime = $timesel->fetch();
    
    ?> 
    
      <?php echo substr($datetime['DateTime'], 0, 16)?>
  
    </p>

    </div>

   </div>   

  <?php
    }
    ?>


  </div>
  </main>

