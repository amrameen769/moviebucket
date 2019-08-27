<?php
require("../config/autoload.php");

$sec = new Secure;
$sec -> checkTSign();

require(SITE_PATH."mv-content/header.php");
?>

<html>
<title>Profile Settings</title>
<body>
<?php


$thr_uname = $_SESSION['thr_uname'];
echo $thr_uname;
$gd = new getData;
$thr_id = $gd->getTheaterId($thr_uname);
$thr_screens = $gd->getScreenDetails($thr_id);
?>
<div class="highlight-blue">
    <div class="container">
        <div class="intro">
            <h2 class="text-center">Profile Settings</h2>
            <p class="text-center">Edit your Profile</p>
        </div>
    </div>
</div>
<?php require(SITE_PATH."mv-content/footer.php");?>
</html>
