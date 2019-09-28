<!DOCTYPE html>
<?php require("../config/autoload.php");
$thr_name = "";
$thr_phone = "";
$thr_uname = "";
$thr_pasd_1 = "";
$thr_mail = "";
$thr_location = "";
$thr_screens = "";
require (SITE_PATH."mv-content/validation.php");

$valid = new Validation();
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Signup for MovieBucket</title>
  </head>
  <link rel="stylesheet" href="../mv-includes/fonts/webfontkit/stylesheet.css">
  <script src="<?=SITE_URL?>mv-includes/bootstrap/jquery/jquery.slim.min.js"></script>
  <script src="<?=SITE_URL?>mv-includes/bootstrap/jquery/popper.min.js"></script>
  <link rel="stylesheet" href="<?=SITE_URL?>mv-includes/bootstrap/css/bootstrap.min.css">
  <script src="<?=SITE_URL?>mv-includes/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?=SITE_URL?>mv-includes/bootstrap/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="<?=SITE_URL?>mv-includes/css/login.css">
  <link rel="stylesheet" href="<?=SITE_URL?>mv-includes/css/animate.css">
  <link rel="stylesheet" href="<?=SITE_URL?>mv-includes/css/style.css">
  <link rel="stylesheet" href="<?=SITE_URL?>mv-includes/fontawesome/css/all.css">
  <script src="<?=SITE_URL?>mv-includes/fontawesome/js/all.js"></script>
  <link rel="stylesheet" href="<?=SITE_URL?>mv-includes/css/responsive.css">
  <link href="<?=SITE_URL?>mv-includes/images/mvbucket.ico" rel="icon" type="image/ico">
  <script src="<?=SITE_URL?>mv-includes/js/script.js"></script>
  <body>
    <div id=center class="container-fluid">
      <div class="col- col-sm col-md col-lg col-xl containera animated fadeInUp delay-02s" style="background: url(../mv-includes/images/thr-bg.jpg) left top repeat !important; width: 1200px;height: 600px;">
        <div class="login_contain animated fadeInDown delay-02s" style="width: 780px!important;">
          <form class="login" method="post">
            <a href="#" onclick="goBack()"><i class="fas fa-arrow-circle-left btn_back"></i></a><br>
            <p id=login>Signup for MovieBucket</p>
          <a href="../index.php"><img id="logo" src="../mv-includes/images/mvbucket.png" alt="moviebucket.com"></a><br>

                      <!--Theater Registration-->

                        <?php
                        $errors = array();
                          if(isset($_POST['signup'])){
                            $thr_name = mysqli_real_escape_string($dbconn,$_POST['thr_name']);
                            $thr_phone = mysqli_real_escape_string($dbconn,$_POST['thr_phone']);
                            $thr_uname = mysqli_real_escape_string($dbconn,$_POST['thr_uname']);
                            $thr_pasd_1 = mysqli_real_escape_string($dbconn,$_POST['thr_pasd_1']);
                            $thr_pasd_2 = mysqli_real_escape_string($dbconn,$_POST['thr_pasd_2']);
                            $thr_mail = mysqli_real_escape_string($dbconn,$_POST['thr_mail']);
                            $thr_location = mysqli_real_escape_string($dbconn,$_POST['thr_location']);
                            $thr_screens = mysqli_real_escape_string($dbconn,$_POST['thr_screens']);

                            if(empty($thr_name)) { array_push($errors,"Theater Name required");}
                            if(empty($thr_uname)) { array_push($errors,"Theater Username required");}
                            if(empty($thr_pasd_1)) { array_push($errors,"Password required");}
                            if(empty($thr_mail)) { array_push($errors,"Email required");}
                            if(empty($thr_screens)) { array_push($errors,"Number of Screens required");}
                            if($thr_pasd_1 != $thr_pasd_2){ array_push($errors, "Passwords Do Not Match");}

                            $hash = mysqli_real_escape_string( md5( $thr_uname + rand( 0,1500 ) ) );

                            if(count($errors) == 0){
                                if($thr_pasd_1 == $thr_uname){ array_push($errors, "Username and Password cannot be the same");}
                                $formArray = array("username"=>$thr_uname, "password" => $thr_pasd_1, "email"=>$thr_mail);

                                $validationErrors = $valid->validate($formArray);
                                foreach ($validationErrors as $validationError){
                                    array_push($errors,$validationError);
                                }
                            }

                            //Validate if Theater already exists
                                $checkExistingQuery = "SELECT thr_uname,thr_mail FROM tbl_theater WHERE thr_uname='$thr_uname' or thr_mail='$thr_mail'";
                                $results = mysqli_query($dbconn,$checkExistingQuery);
                                $theater = mysqli_fetch_assoc($results);
                                if($theater){
                                  if($theater['thr_uname'] === $thr_uname) { array_push($errors, "Theater Username Already Exists");}
                                  if($theater['thr_mail'] === $thr_mail) { array_push($errors, "Email Already Exists");}
                                }

                            if(count($errors) == 0){
                              $psd = md5($thr_pasd_1);
                              $regquery = "INSERT INTO tbl_theater (thr_name,thr_uname,thr_pasd,thr_phone,thr_mail,thr_screens,thr_location,hash)
                              VALUES ('$thr_name', '$thr_uname', '$psd', '$thr_phone', '$thr_mail','$thr_screens','$thr_location','$hash')";
                              if($reg = mysqli_query($dbconn,$regquery)){
                                $_SESSION['thr_name'] = $thr_uname;
                                $_SESSION['success'] = "Signed Up Succesfully";
                                $to_mail = $thr_mail;
                                require (SITE_PATH."mv-content/event-mail.php");
                                  header("location:../mv-content/login.php");
                                }
                                else {
                                  array_push($errors,"Internal Insertion Error");
                                }
                              }
                            }
                          require(SITE_PATH."mv-content/errors.php");
                         ?>
            <div class="inp" style="width: 100%;">
              <input type="text" name="thr_name" placeholder="Theater Name" value ="<?= $thr_name ?>"><br><br>
              <input type="number" name="thr_phone" placeholder="Mobile" value ="<?= $thr_phone ?>"><br><br>
              <input type="username" name="thr_uname" placeholder="Enter Username" value ="<?= $thr_uname ?>"><br><br>
              <input type="password" name="thr_pasd_1" placeholder="Enter Password" value ="<?= $thr_pasd_1 ?>"><br><br>
              <input type="password" name="thr_pasd_2" placeholder="Confirm Password" ><br><br>
              <input type="email" name="thr_mail" placeholder="Email ID" value ="<?= $thr_mail ?>"><br><br>
              <input type="text" name="thr_location" placeholder="Location" value ="<?= $thr_location ?>"><br><br>
              <input type="number" name="thr_screens" placeholder="Number of Screens" value ="<?= $thr_screens ?>"><br><br>
            </div><br>
            <button class="btn_signup" type="submit" name="signup">Signup</button><br>

          </form>
        </div>
      </div>
    </div>
  </body>
</html>
