<?php
require("../config/autoload.php");

require("header.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>
<?php
$errors = array();

if (isset($_SESSION['usertype'])) {
    if (isset($_POST['reset'])) {
        $user_idhash = $_POST['reset'];

        $pasd1 = mysqli_real_escape_string($dbconn, $_POST['pasd1']);
        $pasd2 = mysqli_real_escape_string($dbconn, $_POST['pasd2']);

        if(empty($pasd1) or empty($pasd2)){
            array_push($errors,"Password Fields Empty");
        } else {
            if ($pasd1 == $pasd2) {
                $password = md5($pasd1);
            } else {
                array_push($errors, "Passwords Do not Match");
                unset($_SESSION['usertype']);
                array_push($errors, "Reset Failed");
            }
        }

        if (count($errors) == 0) {
            if ($_SESSION['usertype'] == "theater") {
                $selectThr = $dbconn->query("SELECT thr_id from tbl_theater where concat(thr_id,'',hash) = '$user_idhash'");
                if (mysqli_num_rows($selectThr) == 0) {
                    echo "TEST";
                    array_push($errors, "Hash Expired");
                }
                $hash = md5($username . rand(1500, 5000));
                $updatePassword = $dbconn->query("UPDATE tbl_theater SET thr_pasd = '$password', hash = '$hash' where concat(thr_id,'',hash) = '$user_idhash'");
                array_push($errors, "Password Reset Successful");
            } elseif ($_SESSION['usertype'] == "user") {
                $selectUser = $dbconn->query("SELECT user_id from tbl_user where concat(user_id,'',hash) = '$user_idhash'");
                if (mysqli_num_rows($selectUser) == 0) {
                    array_push($errors, "Hash Expired");
                }
                $hash = md5($username . rand(1500, 5000));
                $updatePassword = $dbconn->query("UPDATE tbl_user SET user_pasd = '$password', hash = '$hash' where concat(user_id,'',hash) = '$user_idhash'");
                array_push($errors, "Password Reset Successful");
            }
        }
    }
    unset($_SESSION['usertype']);
}

if (isset($_GET['username']) and isset($_GET['email']) and $_GET['usertype'] and $_GET['hash']) {
    $username = $_GET['username'];
    $email = $_GET['email'];
    $usertype = $_GET['usertype'];
    $hash = $_GET['hash'];


    if ($usertype == "theater") {
        $checkThr = $dbconn->query("SELECT thr_id from tbl_theater where thr_mail = '$email' and thr_uname = '$username' and hash = '$hash' LIMIT 1");
        if (mysqli_num_rows($checkThr) > 0) {
            $row = mysqli_fetch_assoc($checkThr);
            $thr_id = $row['thr_id'];
            $_SESSION['usertype'] = "theater";
        } else {
            array_push($errors, "Hash Expired");
        }
    } elseif ($usertype == "user") {
        $checkUser = $dbconn->query("SELECT user_id from tbl_user where user_mail = '$email' and user_uname = '$username' and hash = '$hash' LIMIT 1");
        if (mysqli_num_rows($checkUser) > 0) {
            $row = mysqli_fetch_assoc($checkUser);
            $user_id = $row['user_id'];
            $_SESSION['usertype'] = "user";
        } else {
            array_push($errors, "Hash Expired");
        }
    }
    ?>

    <body>
    <div class="container-reset mx-auto d-block">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Reset Password</p>
            </div>
            <div class="card-body">
                <form id="reset-password" method="post" action="reset-password.php">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group"><label for="pasd1"><strong>Enter NewPassword</strong></label><input
                                        class="form-control" type="password" placeholder="Enter New Password"
                                        name="pasd1"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group"><label for="pasd2"><strong>Confirm New
                                        Password</strong></label><input
                                        class="form-control" type="password" placeholder="Confirm Password"
                                        name="pasd2"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm" type="submit" <?php
                        if (isset($user_id)) {
                            echo "value=".$user_id . $hash;
                        } elseif (isset($thr_id)) {
                            echo "value=".$thr_id . $hash;
                        } else {
                            echo "disabled";
                        }
                        ?> name="reset">Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
    <style>
        .container-reset {
            padding: 100px;
            width: 1000px;
            display: block;
        }
    </style>
<?php } ?>
<?php require("errors.php"); ?>
</html>
