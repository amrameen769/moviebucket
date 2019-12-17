<!--
This page is to develop a single interface to add and delete shows of a particular theater
-->

<?php require("../config/autoload.php");


$sec = new Secure;
$sec->checkTSign();


/*
Interacting with:
tbl_showtime
tbl_shows
*/
$thr_uname = $_SESSION['thr_uname'];
$selQuery = "SELECT thr_screens,thr_id FROM tbl_theater WHERE thr_uname = '$thr_uname'";
$results = mysqli_query($dbconn, $selQuery);
if (mysqli_num_rows($results) > 0) {
    $row = mysqli_fetch_assoc($results);
    $thr_screens = $row['thr_screens'];
    $thr_id = $row['thr_id'];
}

$rem = new RemoveData;
$rem->removeShow($thr_id);

$screen = new Screens;
$screen->editShows($thr_id);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Add Show Times</title>
</head>
<?php require(SITE_PATH . "mv-content/header.php"); ?>
<body>
<h1 class="heading distance">Update Shows</h1>

<div class="container-fluid">
    <form class="col- col-sm col-md col-lg col-xl form-movie mx-auto d-block" action="" method="post">
        <br>
        <p class="heading">Add Show Time</p>
        <br>

        <?php
        $errors = array();
        if (isset($_POST['add_showtime'])) {
            $mv_id = mysqli_real_escape_string($dbconn, $_POST['mv_id']);
            $thr_screen_id = mysqli_real_escape_string($dbconn, $_POST['thr_screen_id']);
            $shw_time = mysqli_real_escape_string($dbconn, $_POST['shw_time']);
            $shw_date = mysqli_real_escape_string($dbconn, $_POST['shw_date']);
            $shw_cost = (double)mysqli_real_escape_string($dbconn, $_POST['shw_cost']);

            if (empty($mv_id)) {
                array_push($errors, "Please Select a Movie");
            }
            if (empty($thr_screen_id)) {
                array_push($errors, "Please Add Screen");
            }
            if (empty($shw_time)) {
                array_push($errors, "Please Add Show Time");
            }
            if (empty($shw_date)) {
                array_push($errors, "Please Add Show Date");
            }
            if (empty($shw_cost)) {
                array_push($errors, "Please Add Show Cost");
            }

            require(SITE_PATH . "mv-content/validation.php");
            $validator = new Validation();

            if (count($errors) == 0) {
                $checkShowTimeQuery = "SELECT shw_id FROM tbl_showtime WHERE thr_screen_id = '$thr_screen_id'
                                    AND shw_time = '$shw_time' AND shw_date = '$shw_date' AND thr_id='$thr_id' AND shw_status = 1";
                $resShw = mysqli_query($dbconn, $checkShowTimeQuery);
                if (mysqli_num_rows($resShw) > 0) {
                    array_push($errors, "Another Show exists in the screen at the same time");
                }
            }

            if (count($errors) == 0) {
                if (!$validator->checkRelease($mv_id, $shw_date)) {
                    array_push($errors, "The movie is not yet released!");
                }

                if (!$validator->dateCheck($shw_date)) {
                    array_push($errors, "Show cannot be added on the selected date");
                }

                if (count($errors) == 0) {
                    $timeInterval = $validator->checkShowInterval($thr_screen_id, $shw_time, $shw_date);
                    $minInterval = date("H", mktime(4));
                    $zeroInterval = date("H", mktime(0));

                    $timeInterval['bef'];
                    $timeInterval['aft'];
//            print_r($timeInterval);
                    if ($timeInterval['bef'] != null) {
                        if ($timeInterval['bef'] < $minInterval) {
                            array_push($errors, "Incomplete Show Exists Before Current Show");
                        }
                    } elseif ($timeInterval['aft'] != null) {
                        if ($timeInterval['aft'] < $minInterval) {
                            array_push($errors, "Current Show May Be Incomplete");
                        }
                    }
                }
            }


            $shw_id = '';
            $shw_status = '';

            if (count($errors) == 0) {
                $checkShowQuery = "SELECT shw_id,shw_status FROM tbl_showtime WHERE mv_id = '$mv_id' AND thr_screen_id = '$thr_screen_id'
                                    AND shw_time = '$shw_time' AND shw_date = '$shw_date' AND thr_id='$thr_id'";
                $resShw = mysqli_query($dbconn, $checkShowQuery);

                //$show = new StoreData;

                if (mysqli_num_rows($resShw) > 0) {
                    //echo "There are show ids";
                    $row = mysqli_fetch_assoc($resShw);
                    $shw_id = $row['shw_id'];

                    if ($row['shw_status'] == 1) {
                        array_push($errors, "Show Time already Exists for $thr_uname");
                        //Checking for Show time already Exists
                    } elseif ($row['shw_status'] == 0) {
                        $changeStatusQuery = "UPDATE tbl_showtime SET shw_status = TRUE WHERE shw_id = '$shw_id' AND shw_status = 0";
                        if ($exec->query($changeStatusQuery)) {
                            array_push($errors, "Show Time Updated");
                        }
                    }
                }
            }


            if (count($errors) == 0) {
                //$statusQueryA = "SELECT shw_status FROM tbl_shows WHERE shw_id = '$shw_id' AND thr_id = '$thr_id'";
                $insShw = "INSERT INTO tbl_showtime (mv_id, shw_time,thr_id, thr_screen_id, shw_date, shw_cost, shw_status)
                    VALUES ('$mv_id', '$shw_time','$thr_id', '$thr_screen_id', '$shw_date', '$shw_cost', TRUE)";
                if (mysqli_query($dbconn, $insShw)) {
                    $_SESSION['addshow'] = "Show Time Added";
                    //header("location:add-show.php");
                } else {
                    array_push($errors, "Internal Insertion Error");
                }
            }
        }
        require('../mv-content/errors.php');
        ?>
        <?php if (isset($_SESSION['addshow'])) : ?>
            <div id=error class="animated fadeInDown delay-02s"><p><?= $_SESSION['addshow'] ?></p></div>
            <?php
            unset($_SESSION['addshow']);
        endif ?>
        <?php if (isset($_SESSION['remove_shw'])) : ?>
            <div id=error class="animated fadeInDown delay-02s"><p><?= $_SESSION['remove_shw'] ?></p></div>
            <?php
            unset($_SESSION['remove_shw']);
        endif ?>
        <div class="add-info table-responsive">
            <table class="table">
                <tr>
                    <td id="01">
                        <label for="formGroupExampleInput">Select Movie</label>
                        <select class="form-control field-width" name="mv_id">
                            <option value="0" selected>No Movie Selected</option>
                            <?php
                            $retQuery = "SELECT mv_id, mv_name FROM tbl_movie WHERE rq_status = 1";
                            $results = mysqli_query($dbconn, $retQuery);
                            if (mysqli_num_rows($results) > 0) {
                                while ($row = mysqli_fetch_assoc($results)) {
                                    echo "<option value=";
                                    echo $row['mv_id'];
                                    echo ">";
                                    echo $row['mv_name'];
                                    echo "</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td id="02">
                        <label for="formGroupExampleInput">Screen Name</label>
                        <select class="form-control field-width" name="thr_screen_id">
                            <?php
                            //$i=1;
                            //while($i <= $thr_screens) : ?>
                            <!--<option value="<? //= $i ?>"><? //= $i ?></option>-->
                            <?php //$i++; ?>
                            <?php //endwhile ?>

                            <?php
                            $selectScreens = "SELECT thr_screen_id,thr_screen_name FROM tbl_screens WHERE thr_id = '$thr_id' AND thr_screen_status = 1";
                            $resScreen = $exec->query($selectScreens);
                            if (mysqli_num_rows($resScreen) > 0) {
                                while ($row = mysqli_fetch_assoc($resScreen)) : ?>
                                    <option value="<?= $row['thr_screen_id'] ?>"><?= $row['thr_screen_name'] ?></option>
                                <?php endwhile;
                            }
                            ?>
                        </select>
                    </td>
                    <td id="03">
                        <label for="formGroupExampleInput">Show Time</label>
                        <input class="form-control field-width" id="formGroupExampleInput" type="time" name="shw_time"
                               value="">
                    </td>
                    <td id="04">
                        <label for="formGroupExampleInput">Show Date</label>
                        <input class="form-control field-width" id="formGroupExampleInput" type="date" name="shw_date"
                               value="">
                    </td>
                    <td id="05">
                        <label for="formGroupExampleInput">Show Cost</label>
                        <div class="input-group field-width">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₹</span>
                            </div>
                            <input class="form-control" id="formGroupExampleInput" type="text"
                                   name="shw_cost"
                                   value="">
                        </div>
                    </td>
                    <td>
                        <button type="submit" name="add_showtime" class="btn btn-primary mx-auto d-block">Add Showtime
                        </button>
                    </td>
            </table>
            </tr>
        </div>
    </form>
</div>
<form method="post">
    <div class="table-responsive distance">
        <table class="table">
            <thead>
            <tr>
                <th>Sl. No</th>
                <th>Movie</th>
                <th>Screen</th>
                <th>Show Time</th>
                <th>Date</th>
                <th>Show Cost</th>
                <th>Edit/Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $selIdQuery = "SELECT shw_id from tbl_showtime WHERE thr_id = '$thr_id' AND shw_status = TRUE";
            $resI = mysqli_query($dbconn, $selIdQuery);
            $i = 1;
            if (mysqli_num_rows($resI) > 0):
            while ($row = mysqli_fetch_assoc($resI)):
                $shw_id = $row['shw_id'];
                $selShowQuery = "SELECT * FROM tbl_showtime WHERE shw_id = '$shw_id' AND shw_status = TRUE";
                $results = mysqli_query($dbconn, $selShowQuery);
                if (mysqli_num_rows($results) > 0): ?>
                    <?php
                    while ($row = mysqli_fetch_assoc($results)): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td>
                                <?php
                                $mv_id = $row['mv_id'];
                                $selMovie = "SELECT mv_name from tbl_movie WHERE mv_id = $mv_id LIMIT 1";
                                $res = mysqli_query($dbconn, $selMovie);
                                if (mysqli_num_rows($res) > 0) {
                                    $mov = mysqli_fetch_assoc($res);
                                    echo $mov['mv_name'];
                                }
                                ?>
                            </td>
                            <td><?= $screen->returnScreenName($row['thr_screen_id']) ?></td>
                            <td><?= $row['shw_time'] ?></td>
                            <td><?= $row['shw_date'] ?></td>
                            <td><?= $row['shw_cost'] ?></td>
                            <td>
                                <button class="btn btn-primary" type="submit" name="remove_shw" value="<?= $shw_id ?>">
                                    Remove Show
                                </button>
                                <button class="btn btn-primary" type="submit" name="edit_shw" value="<?= $shw_id ?>">
                                    Edit Show
                                </button>
                            </td>
                        </tr>
                    <?php endwhile ?>
                <?php endif ?>
            <?php endwhile ?>
            </tbody>
        </table>
    </div>
    <?php endif ?>
</form>
<?php require(SITE_PATH . "mv-content/footer.php"); ?>
</html>
