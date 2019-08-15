<?php require("../config/autoload.php");

//check session if any Theater is logged in
if(isset($_SESSION['thr_name'])){
  unset($_SESSION['thr_name']);
}

//check session if any user is logged in

$sec = new Secure;
$sec -> checkUSign();

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
            //unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!--if user logged in Successfully-->
    <?php if(isset($_SESSION['username'])) : ?>
      <!--<div class="jumbotron"><h3>Welcome <strong><$session['username']></strong></h3></div>-->
    <?php require(SITE_PATH."mv-enduser/includes/eu-content.php");?>
    <?php endif ?>
  <?php require(SITE_PATH."mv-content/footer.php");?>
</html>
