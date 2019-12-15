<?php
require("../config/autoload.php");
require("header.php");

$errors = array();

if (isset($_POST['generate'])) {
    $username = mysqli_real_escape_string($dbconn, $_POST['username']);
    $email = mysqli_real_escape_string($dbconn, $_POST['email']);

    if (empty($username)) {
        array_push($errors, "Invalid Username");
    }
    if (empty($email)) {
        array_push($errors, "Invalid Email");
    }

    if (count($errors) == 0) {

        $mailer = $email;
        $user_name = $username;

        $sub = "Reset Account";
        $_SESSION[$username]['reset'] = "Reset Password";

        $checkUser = $dbconn->query("SELECT user_id,hash from tbl_user where user_uname = '$username' and user_mail = '$email' LIMIT 1") or die("Error Checking User, Try Again");
        if (mysqli_num_rows($checkUser) > 0) {
            $row = mysqli_fetch_assoc($checkUser);
            $hash = $row['hash'];
            $mail_body = "<h1>Reset Account</h1><br>";
            $mail_body .= "<strong><p>Verify Account Authenticity: </p></strong>";
            $mail_body .= "https://moviebucket.com/mv-content/reset-password.php?email=" . $email . "&username=" . $username . "&usertype=user" . "&hash=" . $hash;
            require(SITE_PATH . "mv-content/event-mail.php");
        } else {
            $checkThr = $dbconn->query("SELECT thr_id, hash from tbl_theater where thr_uname = '$username' and thr_mail = '$email'");
            if (mysqli_num_rows($checkThr) > 0) {
                $row = mysqli_fetch_assoc($checkThr);
                $hash = $row['hash'];
                $mail_body = "<h1>Reset Account</h1><br>";
                $mail_body .= "<strong><p>Verify Account Authenticity: </p></strong>";
                $mail_body .= "https://moviebucket.com/mv-content/reset-password.php?email=" . $email . "&username=" . $username . "&usertype=theater" . "&hash=" . $hash;
                require(SITE_PATH . "mv-content/event-mail.php");

            } else {
                array_push($errors, "User not Found!");
            }
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Account</title>
</head>
<body>
<div class="container-reset mx-auto d-block">
    <div class="card shadow mb-3">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Reset Password</p>
        </div>
        <div class="card-body">
            <?php require("errors.php") ?>
            <form id="reset-password" method="post" action="reset-account.php">
                <div class="form-row">
                    <div class="col">
                        <div class="form-group"><label for="username"><strong>Username</strong></label><input
                                    class="form-control" type="text" placeholder="username" name="username"/></div>
                    </div>
                    <div class="col">
                        <div class="form-group"><label for="email"><strong>Email Address</strong></label><input
                                    class="form-control" type="email" placeholder="user@example.com" name="email"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm" type="submit" name="generate">Generate Hash</button>
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
</html>
