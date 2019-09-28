<?php
require("../../config/autoload.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Receipt</title>
</head>
<?php
$selected_seats = json_decode(stripcslashes($_POST['seats']));
$shw_id = json_decode(stripcslashes($_POST['shw_id']));
$username = $_SESSION['username'];
$user_name = $username;
$gd = new getData;


$user_mail = $gd->returnUserMail($username);
$mailer = $user_mail;

$mail_body = "";
?>

<body>
<div class="d-flex flex-column" id="content-wrapper">
    <div class="highlight-blue">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Payment Details</h2>
            </div>
        </div>
    </div>
</div>
<?php
$mail_body = $mail_body."<h3>MovieBucket.com - Seats Booked</h3><br><h4>Details</h4><p>";
$mail_body = $mail_body."<p><h4>Seats Booked</h4>";
?>
<div class="container-fluid">
    <div class="card shadow border-left-info py-2">
        <div class="container">
            <h3>Selected Seats</h3>
            <?php foreach ($selected_seats as $selected_seat) : ?>
                <div>
                    <?= "Seat ID: " . $selected_seat ?>
                    <?php $mail_body = $mail_body."Seat ID : ".$selected_seat."<br>"; ?>
                </div>
            <?php endforeach; ?>
            <?php $mail_body = $mail_body."</p>"; ?>
        </div>

        <div class="container">
            <?php
            echo date("d-m-Y H:i:s");
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
            $seatsBooked = $screen->checkSeatIfBooked($shw_id);
            if (is_array($seatsBooked)) {
                if (array_intersect($selected_seats, $seatsBooked) != null) {
                    array_push($errors, "Seats You Selected are Unavailable");
                }
            } else {
                array_push($errors, "Error Selecting Seats");
            }

            ?>
            <?php
            $movieDetails = $mb->selectMovie($mv_id);
            $thr_name = $gd->getTheater($thr_id);
            $thr_screen_name = $screen->returnScreenName($thr_screen_id);
            if (is_array($movieDetails)) : ?>
                <h3>Booking Details</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Movie Name</th>
                            <th>Hero</th>
                            <th>Heroine</th>
                            <th>Language</th>
                            <th>Director</th>
                            <th>Producer</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <?= $movieDetails['mv_name'] ?>
                                <?php $mail_body = $mail_body . "Movie : ". $movieDetails['mv_name']."<br>"; ?>
                                <div class="avatar-upload">
                                    <img class="avatar-preview"
                                         src="<?= SITE_URL ?>/mv-theater/mv-thumb/<?= $movieDetails['mv_thumb'] ?>"
                                         alt="movie_thumb">
                                </div>
                            </td>
                            <td><?= $movieDetails['mv_hero'] ?></td>
                            <td><?= $movieDetails['mv_heroine'] ?></td>
                            <td><?= $movieDetails['mv_lang'] ?></td>
                            <td><?= $movieDetails['mv_director'] ?></td>
                            <td><?= $movieDetails['mv_producer'] ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <h3>Show Details</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Theater</th>
                            <th>Screen ID</th>
                            <th>Show Date</th>
                            <th>Show Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?= $thr_name ?></td>
                            <td><?= $thr_screen_id ?></td>
                            <td><?= $shw_date ?></td>
                            <td><?= $shw_time ?></td>
                            <?php
                            $mail_body = $mail_body . "Theater : ". $thr_name."<br>";
                            $mail_body = $mail_body . "Screen : ". $thr_screen_id."<br>";
                            $mail_body = $mail_body . "Show Date : ". $shw_date."<br>";
                            $mail_body = $mail_body . "Show Time : ". $shw_time."<br>";
                            $mail_body = $mail_body . "Show Cost : ". $shw_cost."<br>";
                            $mail_body = $mail_body . "Total Cost : ". $pay_cost."<br></p></div>";
                            ?>
                        </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <?php
            if (count($errors) == 0) {
                $user_id = $gd->returnUserID($username);
                foreach ($selected_seats as $selected_seat) {
                    $bookDetails = array('user_id' => $user_id, 'shw_id' => $shw_id, 'mv_id' => $mv_id, 'thr_id' => $thr_id, 'thr_screen_id' => $thr_screen_id, 'screen_seat_id' => $selected_seat, 'book_date' => date("Y-m-d H:i:s"), 'book_pay' => $pay_cost);
                    if ($bookShow->book($bookDetails)) {
                        array_push($errors, "Show Booked");
                    } else {
                        array_push($errors, "Booking Failed");
                    }
                }
            }

            require(SITE_PATH . "mv-content/errors.php");
            ?>
        </div>
    </div>
</div>
</body>
</html>

<?php

$sub = "MovieBucket.com Tickets have been Booked";
require ("../../mv-content/event-mail.php");

?>