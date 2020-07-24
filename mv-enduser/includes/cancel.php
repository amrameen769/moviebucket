<?php
require ("../../config/autoload.php");
$cancels = json_decode(stripcslashes($_POST['cancels']));
$errors = array();
foreach ($cancels as $cancel){
    $cancelBooking = "UPDATE tbl_booking set book_status = false where book_id=$cancel and book_status = 1";
    if(!$dbconn->query($cancelBooking)){
        array_push($errors,"Booking ID :".$cancel."Couldn't be cancelled! Please Contact Authority.");
    } else {
        array_push($errors, "Booking ID :".$cancel." is cancelled!");
    }
}
require (SITE_PATH."mv-content/errors.php");
?>

<div class="btn btn-primary animated fadeInDown delay-02s" onclick="window.history.go(-2)">Return</div>
