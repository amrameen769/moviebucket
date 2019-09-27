<!DOCTYPE html>
<?php
$user_mail = "";
$user_name = "";
$user_phone = "";
$user_uname = "";
$user_pasd_1 = "";
 ?>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Signup for MovieBucket</title>
       <link rel="stylesheet" href="../mv-includes/fonts/webfontkit/stylesheet.css">
       <link href="../mv-includes/images/mvbucket.ico" rel="icon" type="image/ico">
       <script src="../mv-includes/bootstrap/jquery/jquery.slim.min.js"></script>
       <script src="../mv-includes/bootstrap/jquery/popper.min.js"></script>
       <link rel="stylesheet" href="../mv-includes/bootstrap/css/bootstrap.min.css">
       <script src="../mv-includes/bootstrap/js/bootstrap.min.js"></script>
       <script src="../mv-includes/bootstrap/js/bootstrap.bundle.min.js"></script>
       <link rel="stylesheet" href="../mv-includes/css/login.css">
       <link rel="stylesheet" href="../mv-includes/css/animate.css">
       <link rel="stylesheet" href="../mv-includes/css/style.css">
       <link rel="stylesheet" href="../mv-includes/fontawesome/css/all.css">
       <script src="../mv-includes/fontawesome/js/all.js"></script>
       <link rel="stylesheet" href="../mv-includes/css/responsive.css">
       <script src="../mv-includes/js/script.js"></script>
   </head>
   <body>
     <div id=center class="container-fluid">
       <div class="col- col-sm col-md col-lg col-xl containera animated fadeInUp delay-02s" style="background: url(../mv-includes/images/user-bg.jpg) left top repeat !important;">
         <div class="login_contain animated fadeInDown delay-02s">
           <form class="login" method="post">
            <a href="#" onclick="goBack()"><i class="fas fa-arrow-circle-left btn_back"></i></a><br>
             <p id=login>Signup for Moviebucket</p>
             <a href="../index.php"><img id="logo" src="../mv-includes/images/mvbucket.png"></a><br>
             <?php require("../config/autoload.php");
             $errors = array();
               if(isset($_POST['signup'])){
                 $user_name = mysqli_real_escape_string($dbconn,$_POST['user_name']);
                 $user_mail = mysqli_real_escape_string($dbconn,$_POST['user_mail']);
                 $user_phone = mysqli_real_escape_string($dbconn,$_POST['user_phone']);
                 $user_uname = mysqli_real_escape_string($dbconn,$_POST['user_uname']);
                 $user_pasd_1 = mysqli_real_escape_string($dbconn,$_POST['user_pasd_1']);
                 $user_pasd_2 = mysqli_real_escape_string($dbconn,$_POST['user_pasd_2']);
             //Validation for Username and Password
                 if(empty($user_uname)) { array_push($errors,"Username required");}
                 if(empty($user_pasd_1)) { array_push($errors,"Password required");}
                 if(empty($user_mail)) { array_push($errors,"Email required");}
                 if($user_pasd_1 != $user_pasd_2){ array_push($errors, "Passwords Do Not Match");}
             //Validate if User already exists
                 $checkExistingQuery = "SELECT user_uname,user_mail FROM tbl_user WHERE user_uname='$user_uname' or user_mail='$user_mail'";
                 $results = mysqli_query($dbconn,$checkExistingQuery);
                 $user = mysqli_fetch_assoc($results);
                 if($user){
                   if($user['user_uname'] === $user_uname) { array_push($errors, "Username Already Exists");}
                   if($user['user_mail'] === $user_mail) { array_push($errors, "Email Already Exists");}
                 }
             //if No errors, add User
                 if(count($errors) == 0){
                   $psd = md5($user_pasd_1);
                   $regquery = "INSERT INTO tbl_user (user_name,user_uname,user_pasd,user_mail,user_phone,user_type)
                   VALUES ('$user_name', '$user_uname', '$psd', '$user_mail', '$user_phone', 'enduser')";
                   if($reg = mysqli_query($dbconn,$regquery)){
                     $_SESSION['username'] = $user_name;
                     $_SESSION['success'] = "Signed Up Succesfully";
                     //require ("mailchimp-subscribe.php");
                       header("location:login.php");
                     }
                     else { array_push($errors,"Internal Insertion Error");}
                   }
                 }
                 require('errors.php');
               ?>
             <div class="inp">
               <input type="text" name="user_name" placeholder="Full Name" value ="<?php echo $user_name; ?>"><br><br>
               <input type="email" name="user_mail" placeholder="Email ID" value ="<?php echo $user_mail; ?>"><br><br>
               <input type="number" name="user_phone" placeholder="Mobile" value ="<?php echo $user_phone; ?>"><br><br>
               <input type="username" name="user_uname" placeholder="Enter Username" value ="<?php echo $user_uname; ?>"><br><br>
               <input type="password" name="user_pasd_1" placeholder="Enter Password" value ="<?php echo $user_pasd_1; ?>"><br><br>
               <input type="password" name="user_pasd_2" placeholder="Confirm Password" >
             </div><br>
             <input class="btn_signup" type="submit" name="signup" value="Signup"><br>
             <a href="../mv-theater/t-registration.php">Sign Up as Theater</a><br>


<!--User Registration for end Users-->


          </form>
        </div>
      </div>
    </div>
  </body>
</html>
