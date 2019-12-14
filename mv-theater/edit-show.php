<?php require("../config/autoload.php");


$sec = new Secure;
$sec->checkTSign();

$gd = new getData();

$thr_uname = $_SESSION['thr_uname'];
$thr_id = $gd->getTheaterId($thr_uname) ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>
        Edit Show
    </title>
</head>
<?php
require(SITE_PATH . "mv-content/header.php");
$errors = array();
if (isset($_POST['shw_id'])) {
    $shw_id = $_POST['shw_id'];
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

    $checkShowQuery = "SELECT shw_id,shw_status,thr_id FROM tbl_showtime WHERE mv_id = '$mv_id' AND thr_screen_id = '$thr_screen_id'
                                    AND shw_time = '$shw_time' AND shw_date = '$shw_date' AND thr_id='$thr_id' AND shw_cost = $shw_cost";
    $resShw = mysqli_query($dbconn, $checkShowQuery);

    //$show = new StoreData;

    if (mysqli_num_rows($resShw) > 0) {
        //echo "There are show ids";
        $row = mysqli_fetch_assoc($resShw);
        $shw_id = $row['shw_id'];

        if ($row['shw_status'] == 1) {
            array_push($errors, "Show Time with Same Attributes already Exists for $thr_uname");
            //Checking for Show time already Exists
        }
    } else {
//        echo $mv_id ." ". $thr_screen_id ." ". $shw_time ." ". $shw_date ." ". $shw_cost . $shw_id;
        if (count($errors) == 0) {
            $updateShow = $dbconn->query("update tbl_showtime set mv_id = '$mv_id', thr_screen_id = '$thr_screen_id', 
                        shw_time = '$shw_time', shw_date = '$shw_date', shw_cost = '$shw_cost', shw_status = TRUE where shw_id = '$shw_id' and thr_id = '$thr_id'")
            or die("Error Updating Show");
            if ($dbconn->affected_rows == 0) {
                array_push($errors, "No Changes Made");
            } else {
                array_push($errors, "Show Time Updated"); ?>
                <button class="btn btn-primary" onclick="window.history.go(-2)">Return</button>
                <?php
            }
        }
//        echo "Error" . $dbconn->error;
    }
}
if (isset($_SESSION['edit-show-id'])) : ?>
    <?php
    $shw_id = $_SESSION['edit-show-id'];
    unset($_SESSION['edit-show-id']);
    $showDet = $gd->returnShow($shw_id);
    $exist_mv_id = $showDet['mv_id'];
    $exist_thr_screen_id = $showDet['thr_screen_id'];
    ?>
    <div class="card shadow mb-3">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Edit Shows - Do not refresh</p>
        </div>
        <div class="card-body">
            <form method="post" action="edit-show.php">
                <div class="form-row">
                    <div class="col">
                        <div class="form-group"><label for="mv_name"><strong>Movie</strong></label><select
                                    class="form-control field-width" name="mv_id">
                                <?php
                                $retQuery = "SELECT mv_id, mv_name FROM tbl_movie WHERE rq_status = 1";
                                $results = mysqli_query($dbconn, $retQuery);
                                if (mysqli_num_rows($results) > 0) {
                                    while ($row = mysqli_fetch_assoc($results)) {
                                        if ($exist_mv_id == $row['mv_id']) {
                                            echo "<option value=" . $row['mv_id'] . " selected>" . $row['mv_name'] . "</option>";
                                        } else {
                                            echo "<option value=";
                                            echo $row['mv_id'];
                                            echo ">";
                                            echo $row['mv_name'];
                                            echo "</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group"><label for="thr_screen_id"><strong>Screen</strong><br/></label>
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
                                        <?php if ($exist_thr_screen_id == $row['thr_screen_id']): ?>
                                            <option value="<?= $row['thr_screen_id'] ?>"
                                                    selected><?= $row['thr_screen_name'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $row['thr_screen_id'] ?>"><?= $row['thr_screen_name'] ?></option>
                                        <?php endif ?>
                                    <?php endwhile;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group"><label for="shw_time"><strong>Show Time</strong></label><input
                                    type="time" class="form-control" value="<?= $showDet['shw_time'] ?>"
                                    name="shw_time"/></div>
                    </div>
                    <div class="col">
                        <div class="form-group"><label for="shw_date"><strong>Show Date</strong></label><input
                                    type="date" class="form-control" value="<?= $showDet['shw_date'] ?>"
                                    name="shw_date"/></div>
                    </div>
                    <div class="col">
                        <div class="form-group"><label for="shw_cost"><strong>Show Cost</strong></label><input
                                    class="form-control" type="text" value="<?= $showDet['shw_cost'] ?>"
                                    name="shw_cost"/></div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm" type="submit" value="<?= $shw_id ?>" name="shw_id">Save
                        Show
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php endif ?>
<?php require(SITE_PATH . "mv-content/errors.php");
require (SITE_PATH."mv-content/footer.php") ?>
