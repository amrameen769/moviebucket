<?php
require("../../config/autoload.php");
if (!isset($_SESSION['username']) || $_SESSION['user_type'] != 'admin') {
    header("location:../../index.php");
}
?>


<!DOCTYPE html>
<html>

<?php //require(SITE_PATH . "mv-content/header.php");?>
<title>Theater Requests</title>
<?php if (isset($_SESSION['username'])) : ?>
    <?php require(SITE_PATH . "mv-admin/includes/ad-header.php"); ?>
    <body class="animated fadeInDown delay-02s" id="page-top">
    <div class="d-flex flex-column" id="content-wrapper">
        <div class="highlight-blue">
            <div class="container">
                <div class="intro">
                    <h2 class="text-center">Theater Requests</h2>
                    <p class="text-center">Invoke or Revoke Theater Access</p>
                </div>
                <div class="buttons"></div>
                <?php
                $errors = array();
                if (isset($_POST['status_btn'])) {
                    $thr_id = mysqli_real_escape_string($dbconn, $_POST['status_btn']);
                    $selectStatus = "SELECT thr_status FROM tbl_theater where thr_id='$thr_id'";
                    $results = $exec->query($selectStatus);
                    if (mysqli_num_rows($results) > 0) {
                        if ($row = mysqli_fetch_assoc($results)) {
                            $thr_status = $row['thr_status'];
                            if ($thr_status == 0) {
                                $updateStatus = "UPDATE tbl_theater SET thr_status = TRUE WHERE thr_id='$thr_id'";
                            } elseif ($thr_status == 1) {
                                $updateStatus = "UPDATE tbl_theater SET thr_status = FALSE WHERE thr_id='$thr_id'";
                            }
                            if ($exec->query($updateStatus)) {
                                array_push($errors, "Status Updated");
                            } else {
                                array_push($errors, "Status Updated");
                            }
                        }
                    }
                }
                require(SITE_PATH . "mv-content/errors.php");
                ?>
            </div>
        </div>
        <form action="" method="post">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Theater ID</th>
                        <th>Theater Name</th>
                        <th>Username</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>No: of Screens</th>
                        <th>Location</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <?php
                    $selTheater = "SELECT * FROM tbl_theater ORDER BY thr_status";
                    $results = $exec->query($selTheater);
                    if (mysqli_num_rows($results) > 0) : ?>
                        <tbody>
                        <?php while ($theater = mysqli_fetch_assoc($results)) : ?>
                            <tr>
                                <td><?= $theater['thr_id'] ?></td>
                                <td><?= $theater['thr_name'] ?></td>
                                <td><?= $theater['thr_uname'] ?></td>
                                <td><?= $theater['thr_phone'] ?></td>
                                <td><?= $theater['thr_mail'] ?></td>
                                <td><?= $theater['thr_screens'] ?></td>
                                <td><?= $theater['thr_location'] ?></td>
                                <td>
                                    <?php if ($theater['thr_status'] == 1) : ?>
                                        <button class="btn btn-dark" type="submit" value="<?= $theater['thr_id'] ?>"
                                                name="status_btn">
                                            Revoke
                                        </button>
                                    <?php elseif ($theater['thr_status'] == 0) : ?>
                                        <button class="btn btn-dark" type="submit" value="<?= $theater['thr_id'] ?>"
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