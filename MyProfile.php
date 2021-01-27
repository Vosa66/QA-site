<?php

include_once('config.php');
include('header.php');

?>


<div class="sidenav profile-side">
  <h3 class="user"> <?php echo $_SESSION['Username'] ?> </h3>
  <h3 class="user"> <?php echo $_SESSION['FirstLastName'] ?> </h3>
  <h6> <a href="LogOut.php">Log Out</a> </h6>
</div>



<div class="container">
    <div class="row">
        <div class="form_bg profile">
            <form action="Update.php" method="POST">
                 <h2 class="text-center">Update your info!</h2>
                <br/>
                <div class="form-group">
                    <input type="text" name="Username" class="form-control" value="<?=$_SESSION['Username']?>" disabled>
                </div>
                <div class="form-group">
                    <input type="text" name="FirstLastName" class="form-control" value="<?=$_SESSION['FirstLastName']?>" required>
                </div>
                <div class="form-group">
                    <input type="email" name="Email" class="form-control" value="<?=$_SESSION['Email']?>" required>
                </div>
                <div class="form-group">
                    <input type="password" name="Password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" name="ConfPass" class="form-control" placeholder="Confirm Password" required>
                </div>
                <br/>
                <div class="align-center">
                    <button type="submit" name="update" class="btn btn-default">Update!</button>
                </div>
                
            </form>
        </div>
    </div>
</div>


</form>


<?php

include('footer.php');

?>

</main>