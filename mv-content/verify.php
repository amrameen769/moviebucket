<?php
require("../config/autoload.php");

if (isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash'])) {
    $email = mysqli_real_escape_string($dbconn, $_GET['email']);
    $hash = mysqli_real_escape_string($dbconn, $_GET['hash']);

    $selVerify = "SELECT user_id FROM tbl_user WHERE user_mail ='$email' AND hash = '$hash' AND verified IS NULL LIMIT 1";
    $resVerify = $dbconn->query($selVerify);

    if (mysqli_num_rows($resVerify) > 0) {
        while ($row = mysqli_fetch_assoc($resVerify)) {
            $user_id = $row['user_id'];
        }
        $updateVerify = "UPDATE tbl_user SET verified = 'ACTIVE' WHERE user_id='$user_id'";
        if ($dbconn->query($updateVerify)) {
            echo "
                <div>
                <p>Verified. Click here to Login.</p>
                <a href='" . SITE_URL . "mv-content/login.php'>Login</a>
                </div>
                ";
        }
    } else {
        $selVerify = "SELECT thr_id FROM tbl_theater WHERE thr_mail ='$email' AND hash = '$hash' AND verified IS NULL";
        $resVerify = $dbconn->query($selVerify);

        if (mysqli_num_rows($resVerify) > 0) {
            while ($row = mysqli_fetch_assoc($resVerify)) {
                $thr_id = $row['thr_id'];
            }
            $updateVerify = "UPDATE tbl_theater SET verified = 'ACTIVE' WHERE thr_id='$thr_id'";
            if ($dbconn->query($updateVerify)) {
                echo "
                <div>
                <p>Verified. Please Wait a little time until the Authority validate your Existence. Click Here to Login.</p>
                <a href='" . SITE_URL . "mv-content/login.php'>Login</a>
                </div>
                ";
            }
        } else { ?>
            <div id=error class="animated fadeInDown delay-02s">
                <p>You are screwed, Hell! Eeaaaster Egg!</p>
            </div>
            <?php
        }
    }
}
?>