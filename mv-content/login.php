<?php require("../config/autoload.php"); ?>

<!-- Login for All Users -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login to MovieBucket</title>
    <script src="../mv-includes/bootstrap/jquery/jquery.slim.min.js"></script>
    <script src="../mv-includes/bootstrap/jquery/popper.min.js"></script>
    <link rel="stylesheet" href="../mv-includes/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../mv-includes/fonts/webfontkit/stylesheet.css">
    <script src="../mv-includes/bootstrap/js/bootstrap.min.js"></script>
    <script src="../mv-includes/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../mv-includes/css/login.css">
    <link rel="stylesheet" href="../mv-includes/css/animate.css">
    <link rel="stylesheet" href="../mv-includes/css/style.css">
    <link rel="stylesheet" href="../mv-includes/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="../mv-includes/css/responsive.css">
    <link href="<?= SITE_URL ?>mv-includes/images/mvbucket.ico" rel="icon" type="image/ico">
</head>
<body>
<div id=center class="container-fluid">
    <div class="col- col-sm col-md col-lg col-xl containera animated fadeInUp delay-02s"
         style="background: url(../mv-includes/images/cine-bg.jpg) left top repeat !important;">
        <div class="login_contain animated fadeInDown delay-02s">
            <form class="login high" method="post">
                <?php if (isset($_SESSION['msg'])) : ?>
                    <p id="login">
                        <?php echo $_SESSION['msg'];
                        unset($_SESSION['msg']); ?>
                    </p>
                <?php endif ?>
                <?php if (isset($_SESSION['subscription'])) : ?>
                    <p id="login">
                        <?php echo $_SESSION['subscription'];
                        unset($_SESSION['subscription']); ?>
                    </p>
                <?php endif ?>
                <p id="login">Login to MovieBucket</p>
                <a href="../index.php"><img alt="moviebucket.com" id="logo"
                                            src="../mv-includes/images/mvbucket.png"></a><br>

                <!-- Validation and Login to the respective Home Pages for all users -->

                <?php
                $errors = array();
                if (isset($_POST['login'])) {
                    $user_uname = mysqli_real_escape_string($dbconn, $_POST['user_uname']);
                    $user_pasd = mysqli_real_escape_string($dbconn, $_POST['user_pasd']);
                    if (empty($user_uname)) {
                        array_push($errors, "Username required");
                    }
                    if (empty($user_pasd)) {
                        array_push($errors, "Password required");
                    }
                    if (count($errors) == 0) { #if no errors search and find username from the table
                        $psd = md5($user_pasd);
                        $logquery = "SELECT user_name,user_type,verified FROM tbl_user WHERE user_uname='$user_uname' AND user_pasd='$psd'";
                        $results = mysqli_query($dbconn, $logquery);
                        if (mysqli_num_rows($results) > 0) { #if there is a result check if the usertype is admin or user
                            $_SESSION['username'] = $user_uname;
                            //$_SESSION['success'] = "Logged in Successfully";
                            $row = mysqli_fetch_assoc($results);
                            if ($row['verified'] !== 'ACTIVE') {
                                array_push($errors, "Your Email is not Verified");
                            } else {
                                if ($row['user_type'] == 'admin') {
                                    $_SESSION['user_type'] = "admin";
                                    header("location:../mv-admin/");#To Admin PAge
                                } else if ($row['user_type'] == 'enduser') {
                                    $_SESSION['user_type'] = "enduser";
                                    header("location:../mv-enduser/home.php");#To User Home
                                }
                            }
                        } else if (mysqli_num_rows($results) == 0) {#If there is no result check the theater table for same
                            $tlogquery = "SELECT thr_name,thr_status,verified FROM tbl_theater WHERE thr_uname='$user_uname' AND thr_pasd='$psd'";
                            $results = mysqli_query($dbconn, $tlogquery);
                            if (mysqli_num_rows($results) > 0) { #if there is a result
                                if ($row = mysqli_fetch_assoc($results)) {
                                    if ($row['thr_status'] == 1) {
                                        $_SESSION['thr_uname'] = $user_uname;
                                        $_SESSION['user_type'] = "theater";
                                        //$_SESSION['success'] = "Logged in Successfully";
                                        header("location:../mv-theater/home.php"); #to Theater home
                                    } elseif ($row['verified'] !== 'ACTIVE') {
                                        array_push($errors, "Your Email is not Verified");
                                    } else {
                                        array_push($errors, "Sorry, You are not yet Validated");
                                    }
                                }
                            } else {
                                array_push($errors, "Username or Password Incorrect");
                                //foreach($errors as $error) {echo "<div id=error><span>$error</span></div><br>";}
                            }
                        }
                    }
                }
                require('errors.php');
                ?>

                <div class="inp">
                    <input type="text" name="user_uname" placeholder="Enter Username"><br><br>
                    <input type="password" name="user_pasd" placeholder="Enter Password">
                </div>
                <br>
                <input type="submit" class="btn_login" name="login" value="Login"><br>
                <a href="registration.php">Don't Have Account? Signup</a><br>
                <p id="fp">Forgot Password?</p>

                <!--</form>
              </div>
              </div>
            </div>
          </body>
        </html>-->


            </form>
        </div>
    </div>
</div>
</body>
</html>
