<?php
require ("../config/autoload.php");

$sec = new Secure;
$sec->checkTSign();

$errors = array();
if (isset($_POST)) {
    $screen = new Screens;
    $screen_name = mysqli_real_escape_string($dbconn,$_POST['screen_name']);
    $seat_number = mysqli_real_escape_string($dbconn,$_POST['seat_number']);
    $thr_screen_id = $_POST['sid'];
    if(empty($screen_name)){ array_push($errors,"No Name Entered");}
    if(empty($seat_number)){ array_push($errors,"No Seat Number Entered");}
    $thr_uname = $_SESSION['thr_uname'];
    $gd = new getData;
    $thr_id = $gd->getTheaterId($thr_uname);
    $thr_screen_id;
    $selectScreen = "SELECT def_screen_id FROM tbl_screens WHERE thr_screen_id = '$thr_screen_id' AND thr_screen_status = 1";
    $resScreen = $exec->query($selectScreen);
    if(mysqli_num_rows($resScreen) > 0) {
        array_push($errors, "Screen Already Initialized");
    } else {
        if(empty($errors)){
            $addScreen = "UPDATE tbl_screens SET thr_screen_name = '$screen_name',seat_number = '$seat_number',thr_screen_status = true WHERE thr_screen_id='$thr_screen_id'";
            if($exec->query($addScreen)){
                array_push($errors,"Successful Initiation");
                array_push($errors, $screen->initSeats($thr_screen_id,$seat_number));
            } else {
                array_push($errors,"Initiation Failed");
            }
        }
    }
}
require (SITE_PATH."mv-content/errors.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
</body>
</html>
