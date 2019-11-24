<?php
require("../config/autoload.php");
require(SITE_PATH . "/config/DisplayDet.php");
$sec = new Secure;
$sec->checkUSign();

require(SITE_PATH . "mv-content/header.php");

?>

<head>
    <title>Bookings</title>
</head>

<body>
<div class="highlight-blue" style="height: 263px;">
    <div class="container">
        <div class="intro">
            <?php
            //print_r($_SESSION);
            $username = $_SESSION['username'];
            $gd = new getData;
            $user_details = $gd->returnUserDetails($username);
            $user_id = $user_details['user_id'];
            ?>
            <h2 class="text-center">Booked Shows</h2>
            <p class="text-center">Review or Cancel Bookings</p>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th style="width: 6px;">Booking ID</th>
            <th style="height: 50px;width: 10px;">Movie</th>
            <th style="height: 59px;width: 27px;">Theater</th>
            <th style="width: 44px;">Screen</th>
            <th style="width: 38px;">Seat Details</th>
            <th style="width: 53px;">Show Date</th>
            <th style="width: 52px;">Show Time</th>
            <th style="width: 78px;">Book Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        //print_r($resBookDetails);
        $book = new Booking;
        $bookingDetails = $book->bookingDetails($user_id);
        $dd = new DisplayDet();
        if (!is_array($bookingDetails) && !empty($bookingDetails)) : ?>
            <?php foreach ($bookingDetails as $bookingDetail) : ?>
                <tr>
                    <?php
                    $detArray = array("shw_id" => $bookingDetail['shw_id']);
                    $detail = $dd->returnBooking($detArray);
                    ?>
                    <td><?= $bookingDetail['book_id'] ?></td>
                    <td><?= $detail['mv_name'] ?></td>
                    <td><?= $detail['thr_name'] ?></td>
                    <td><?= $detail['thr_screen_name'] ?></td>
                    <td><?= $bookingDetail['screen_seat_id'] ?></td>
                    <td><?= $detail['shw_date'] ?></td>
                    <td><?= $detail['shw_time'] ?></td>
                    <td><?= $bookingDetail['book_date'] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
