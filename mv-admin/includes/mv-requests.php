<?php
require("../../config/autoload.php");
if (!isset($_SESSION['username']) || $_SESSION['user_type'] != 'admin') {
    header("location:" . SITE_PATH . "index.php");
}

$sec = new Secure;
$sec->checkADSign();

?>


<!DOCTYPE html>
<html>

<?php //require(SITE_PATH . "mv-content/header.php");?>
<title>Movie Requests</title>
<?php if (isset($_SESSION['username'])) : ?>
    <?php require(SITE_PATH . "mv-admin/includes/ad-header.php"); ?>
    <body class="animated fadeInDown delay-02s" id="page-top">
    <div class="d-flex flex-column" id="content-wrapper">
        <div class="highlight-blue">
            <div class="container">
                <div class="intro">
                    <h2 class="text-center">Movie Requests</h2>
                    <p class="text-center">Edit or Delete Movie Requests</p>
                </div>
                <div class="buttons"></div>
                <?php
                $errors = array();
                if (isset($_POST['status_btn'])) {
                    $mv_id = mysqli_real_escape_string($dbconn, $_POST['status_btn']);
                    $selectStatus = "SELECT rq_status FROM tbl_movie where mv_id='$mv_id' AND mv_status=TRUE";
                    $results = $exec->query($selectStatus);
                    if (mysqli_num_rows($results) > 0) {
                        if ($row = mysqli_fetch_assoc($results)) {
                            $rq_status = $row['rq_status'];

                            if ($rq_status == 0) {
                                $updateStatus = "UPDATE tbl_movie SET rq_status = TRUE WHERE mv_id='$mv_id'";
                                if ($exec->query($updateStatus)) {
                                    array_push($errors, "Status Updated");
                                    //$_SESSION['updation'] = "Status Updated, Shows Removed";
                                    //header("location:mv-requests.php");
                                }
                            } elseif ($rq_status == 1) {
                                $flag = 1;
                                $updateStatus = "UPDATE tbl_movie SET rq_status = FALSE WHERE mv_id='$mv_id'";
                                $selectShow = "SELECT shw_id FROM tbl_showtime WHERE mv_id = $mv_id";
                                $resShow = $exec->query($selectShow);
                                if (mysqli_num_rows($resShow) > 0) {
                                    while ($row = mysqli_fetch_assoc($resShow)) {
                                        $shw_id = $row['shw_id'];
                                        $removeShow = "UPDATE tbl_showtime SET shw_status = FALSE WHERE shw_id=$shw_id";
                                        if (!$exec->query($removeShow)) {
                                            $flag = 0;
                                        }
                                    }
                                }
                                if ($exec->query($updateStatus) && $flag == 1) {
                                    array_push($errors, "Status Updated, Shows Removed");
                                    //$_SESSION['updation'] = "Status Updated, Shows Removed";
                                    //header("location:".SITE_PATH."mv-admin/includes/mv-requests.php");
                                }
                            }
                        }
                    } else {
                        array_push($errors, "Movie isn't Enrolled");
                    }
                }
                require(SITE_PATH . "mv-content/errors.php");
                if (isset($_SESSION['updation'])) : ?>
                    <div id=error class="animated fadeInDown delay-02s">
                        <p>
                            <?php echo $_SESSION['updation'];
                                unset($_SESSION['updation']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <form action="" method="post">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Movie ID</th>
                        <th>Movie Name</th>
                        <th>Hero</th>
                        <th>Heroine</th>
                        <th>Language</th>
                        <th>Director</th>
                        <th>Producer</th>
                        <th>Theater Name</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <?php
                    $selMovie = "SELECT * FROM tbl_movie ORDER BY rq_status";
                    $results = $exec->query($selMovie);
                    if (mysqli_num_rows($results) > 0) : ?>
                        <tbody>
                        <?php while ($movie = mysqli_fetch_assoc($results)) : ?>
                            <tr>
                                <td><?= $movie['mv_id'] ?></td>
                                <td>
                                    <?= $movie['mv_name'] ?>
                                    <div class="avatar-upload">
                                        <img class="avatar-preview"
                                             src="<?= SITE_URL ?>/mv-theater/mv-thumb/<?= $movie['mv_thumb'] ?>"
                                             alt="movie_thumb">
                                    </div>
                                </td>
                                <td><?= $movie['mv_hero'] ?></td>
                                <td><?= $movie['mv_heroine'] ?></td>
                                <td><?= $movie['mv_lang'] ?></td>
                                <td><?= $movie['mv_director'] ?></td>
                                <td><?= $movie['mv_producer'] ?></td>
                                <td>
                                    <?php
                                    $get = new getData;
                                    echo $get->getTheater($movie['thr_id']);
                                    ?>
                                </td>
                                <td>
                                    <?php if ($movie['rq_status'] == 1) : ?>
                                        <button class="btn btn-dark" type="submit" value="<?= $movie['mv_id'] ?>"
                                                name="status_btn">
                                            Revoke
                                        </button>
                                    <?php elseif ($movie['rq_status'] == 0) : ?>
                                        <button class="btn btn-dark" type="submit" value="<?= $movie['mv_id'] ?>"
                                                name="status_btn">
                                            Invoke
                                        </button>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endwhile ?>
                        </tbody>
                    <?php endif ?>
                </table>
            </div>
        </form>
        <?php require(SITE_PATH . "mv-admin/includes/ad-footer.php"); ?>
    </div>
    </body>
<?php endif ?>
</html>