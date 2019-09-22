<?php require("../../config/autoload.php");

$sec = new Secure;
$sec->checkUSign();

require(SITE_PATH . "mv-content/header.php");

$shw_id = $_POST['shw_id'];

$mb = new MovieBook;

$shw_cost = $mb->returnShowCost($shw_id);
$screen = new Screens;
$thr_screen_id = $screen->returnScreenId($shw_id);

$seat_number = $screen->returnScreenSeats($thr_screen_id);

?>

<head>
    <title>
        Select Seats
    </title>
</head>

<body class="container-fluid">
<div class="d-flex flex-column" id="content-wrapper">
    <div class="highlight-blue">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Book Seats</h2>
                <p class="text-center">Select Your Seats</p>
                <p class="text-center">Per Booking - <?=$shw_cost ?></p>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div id="confirm-book" class="seat-layout mx-auto d-block">
        <table class="table">
            <tr>
                <td>
                    <div class="row row--1 row-margin" style="justify-content: center;">
                        <?php
                        $i = 1;
                        $resSeats = $screen->returnSeats($thr_screen_id);
                        $seatsBooked = $screen->checkSeatIfBooked($shw_id);

                        while ($seat = mysqli_fetch_assoc($resSeats)) : ?>
                            <div class="seat">
                                <input type="checkbox" value="<?= $shw_cost ?>" name="seat"
                                       id="<?= $seat['screen_seat_id'] ?>"
                                    <?php
                                    if (is_array($seatsBooked) && !empty($seatsBooked)) {
                                        if(in_array($seat['screen_seat_id'],$seatsBooked)){
                                            echo "disabled";
                                        }
                                    }
                                    ?>
                                       onclick="addpay(this.id, this.value)"
                                >
                                <label for="<?= $seat['screen_seat_id'] ?>"><?= $i++; ?></label>
                            </div>
                            <?php if ($i % 15 == 0) {
                                echo "</div><div class=\"row row--1 row-margin\" style='justify-content: center;'>";
                            } ?>
                        <?php endwhile; ?>
                    </div>
                </td>
            </tr>
        </table>
        <div class="screen-img">All Eyes Here!</div>
    </div>
    <div class="en-flex" style="justify-content: center;">
        <button class="btn btn-primary" id="pay" value="<?=$shw_id ?>" onclick="selectSeat()">Pay</button>
    </div>
</div>
</body>