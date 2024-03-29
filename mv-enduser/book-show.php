<?php
require("../config/autoload.php");

$sec = new Secure;
$sec->checkUSign();

require(SITE_PATH . "mv-content/header.php");
?>
<head>
    <title>
        Book Shows
    </title>
</head>
<?php
if (isset($_REQUEST['mvid'])) {
$mv_id = $_REQUEST['mvid'];
$errors = array();
$gd = new getData;
$mb = new MovieBook;
$screen = new Screens;
$movie = $mb->selectMovie($mv_id);
$shows = $mb->selectShows($mv_id);

if (count($shows) == 0) : ?>
    <div class="jumbotron text-center" id="not-found"><h1>No Shows Found!</h1></div>
<?php exit(0); endif;
?>
<div class="row row-margin animated fadeInDown delay-02s">

    <?php
    if (is_array($shows)) : ?>
        <?php foreach ($shows as $show) : ?>
            <?php if (is_array($show)) : ?>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                        <span>
                                            <img src="<?= SITE_URL ?>mv-theater/mv-thumb/<?= $movie['mv_thumb'] ?>"
                                                 alt="mv-thumb.jpg">
                                        </span>
                                    </div>
                                    <div class="text-dark font-weight-bold h5 mb-0">
                                        <span><?= $gd->getTheater($show['thr_id']) ?></span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0">
                                        <span><?= $screen->returnScreenName($show['thr_screen_id']) ?></span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0">
                                        <span><?= $show['shw_date'] ?></span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0">
                                        <span><?= $show['shw_time'] ?></span></div>
                                    <button class="btn btn-primary" name="btn-mov-book"
                                            value="<?= $show['shw_id'] ?>" onclick="bookSeats(this.value)">Select
                                        Seats
                                    </button>
                                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif;
        endforeach;
    else : ?>
        <!--//            array_push($errors,"No data Recieved");-->
    <?php endif;
    //require(SITE_PATH . "mv-content/errors.php");
    }
    ?>
</div>
