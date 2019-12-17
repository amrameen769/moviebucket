<?php require("../config/autoload.php");

//check session if any user is logged in
if(isset($_SESSION['username'])){
  echo $_SESSION['username'];
  unset($_SESSION['username']);
}
//check if any theater is logged in

$sec = new Secure;
$sec -> checkTSign();


//check for logout

if(isset($_GET['logout'])){
  session_destroy();
  header("location:../mv-content/login.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
  </head>
  <!--Header-->
  <?php require(SITE_PATH."mv-content/header.php"); ?>
  <body>
    <?php if(isset($_SESSION['success'])) : ?>
      <div class="">
        <h3>
          <?php
            //echo $_SESSION['success'];
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>
    <?php if(isset($_SESSION['thr_uname'])) : ?>
        <div class="jumbotron"><h3>Welcome <strong><?= $_SESSION['thr_uname']?></strong></h3></div>
        <a href="add-movie.php"><button type="button" class="btn btn-primary" value="addmovie""><span class="badge badge-dark">1</span> &nbsp;Update Movie List</button></a>
        <a href="add-show.php"><button type="button" class="btn btn-primary" value="addshow"><span class="badge badge-dark">2</span> &nbsp;Update Shows</button></a>
    <?php endif ?>
    <!--if user logged in Successfully-->

  <?php require(SITE_PATH."mv-content/footer.php");?>
</html>
