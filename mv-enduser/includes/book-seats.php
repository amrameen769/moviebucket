<?php
$selected_seats = json_decode(stripcslashes($_POST['seats']));
$shw_id = json_decode(stripcslashes($_POST['shw_id']));
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
</head>
<?php
require("../../config/autoload.php");
$username = $_SESSION['username'];
?>

<body>
<div class="container-fluid">
    <div class="card shadow border-left-info py-2">
        <div class="container">
            <h3>Selected Seats</h3>
            <?php foreach ($selected_seats as $selected_seat) : ?>
                <div>
                    <?= "Seat ID: " . $selected_seat ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="container">
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
            }

            require(SITE_PATH . "mv-content/errors.php");
            ?>
            <?php
            $movieDetails = $mb->selectMovie($mv_id);
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
                        </tr>
                        </tbody>
                    </table>
                </div>
                <form action="<?=SITE_URL?>/mv-enduser/includes/success.php" method="post">
                    <button class="btn btn-primary" id="checkout" name="checkout">Proceed Checkout</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
