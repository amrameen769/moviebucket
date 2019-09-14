<?php

$mv_id = "";
$shw_time = "";
$thr_id = "";
$thr_screen_id = "";
$shw_date = "";
$shw_cost = "";
$shw_status = "";
$selectShowDetails = "SELECT * FROM tbl_showtime WHERE shw_id='$shw_id' LIMIT 1";
$resShows = $exec->query($selectShowDetails);
if (mysqli_num_rows($resShows) > 0) {
    while ($row = mysqli_fetch_assoc($resShows)) {
        $mv_id = $row['mv_id'];
        $shw_time = $row['shw_time'];
        $thr_id = $row['thr_id'];
        $thr_screen_id = $row['thr_screen_id'];
        $shw_date = $row['shw_date'];
        $shw_cost = $row['shw_cost'];
        $shw_status = $row['shw_status'];
    }
}

$errors = array();
$pay_cost = $shw_cost * count($selected_seats);

if ($shw_status == 0) {
    array_push($errors, "Show Doesn't Exist");
}
$gd = new getData;
$mb = new MovieBook;
$screen = new Screens;
$seatAccess = new Seats;
$bookShow = new Booking;
$seatsNotBooked = $seatAccess->seatsNotBooked($thr_screen_id);
if (is_array($seatsNotBooked)) {
    if (!array_diff($selected_seats, array_intersect($selected_seats, $seatsNotBooked)) == null) {
        array_push($errors, "Seats You Selected are Unavailable");
    }
} else {
    array_push($errors, "Error Selecting Seats");
}

if (count($errors) == 0) {
    $thr_name = $gd->getTheater($thr_id);
    $thr_screen_name = $screen->returnScreenName($thr_screen_id);
    if(isset($_POST['checkout'])){
        if($seatAccess->bookSelectedSeats($selected_seats)){
            $user_id = $gd->returnUserID($username);
            foreach ($selected_seats as $selected_seat){
                $bookDetails = array('user_id'=>$user_id,'shw_id'=>$shw_id, 'mv_id'=>$mv_id,'thr_id'=>$thr_id,'thr_screen_id'=>$thr_screen_id,'screen_seat_id'=>$selected_seat,'book_date'=>date("Y-m-d H:i:s"),'book_pay'=>$pay_cost);
                if($bookShow->book($bookDetails)){
                    echo "Succesfully Booked Ticket!";
                } else {
                    array_push($errors,"Booking Failed");
                }
            }
        }
    }
}

require(SITE_PATH . "mv-content/errors.php");

?>