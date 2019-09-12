<?php require("../../config/autoload.php");

$sec = new Secure;
$sec->checkUSign();

require(SITE_PATH . "mv-content/header.php");

$shw_id = $_POST['shw_id'];

$screen = new Screens;
$thr_screen_id = $screen->returnScreenId($shw_id);

$seat_number = $screen->returnScreenSeats($thr_screen_id);

?>

<body class="container-fluid">
<div class="d-flex flex-column" id="content-wrapper">
    <div class="highlight-blue">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Book Seats</h2>
                <p class="text-center">Select Your Seats</p>
            </div>
        </div>
    </div>
</div>
<div class="seat-layout mx-auto d-block">
    <table class="table">
        <tr>
            <td>
                <div class="row row--1 row-margin" style="justify-content: center;">
            <?php
                $i=1;
                $resSeats = $screen->returnSeats($thr_screen_id);

                while ($seat = mysqli_fetch_assoc($resSeats)) : ?>
                    <div class="seat">
                        <input type="checkbox" id="<?= $seat['screen_seat_id'] ?>"
                            <?php
                            if($seat['seat_book_status'] == 1){
                                echo "disabled";
                            }
                            ?>
                        >
                        <label
                                for="<?= $seat['screen_seat_id'] ?>"><?=$i++; ?></label>
                    </div>
                    <?php if($i%15 == 0) { echo "</div><div class=\"row row--1 row-margin\" style='justify-content: center;'>";} ?>
                <?php endwhile; ?>
                    </div>
            </td>
        </tr>
    </table>
    <div class="screen-img">All Eyes Here!</div>
</div>
<div class="en-flex" style="justify-content: center;">
    <button class="btn btn-primary" id="pay" onclick="selectSeat()">Payment</button>
</div>
</body>