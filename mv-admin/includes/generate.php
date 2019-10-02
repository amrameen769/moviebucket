<?php
require('../../config/autoload.php');

if (isset($_POST['reportid'])) {
    $report_id = $_POST['reportid'];
    ob_start();
    if ($report_id == 'annual') : ?>
        <div>
            <div class="highlight-blue">
                <div class="container">
                    <div class="intro">
                        <h2 class="text-center">Income Reports</h2>
                        <p class="text-center">Annual Income Reports in MovieBucket</p>
                    </div>
                    <div class="buttons"></div>
                </div>
            </div>

            <?php


            ?>


            <button class="btn btn-primary btn-sm d-none d-sm-inline-block" id="d-button">Download</button>
        </div>

    <?php elseif ($report_id == 'show') : ?>

        <div>
            <div class="highlight-blue">
                <div class="container">
                    <div class="intro">
                        <h2 class="text-center">Show Reports</h2>
                        <p class="text-center">Annual Showtime Reports in MovieBucket</p>
                    </div>
                    <div class="buttons"></div>
                </div>
            </div>

            <?php
            //$date = date('m', mktime(0, 0, 0, 9, 1, 2019)); $selectShow = "SELECT * FROM tbl_showtime WHERE shw_date >= '$date'";
            $selectShow = "SELECT * FROM tbl_showtime";
            $resShow = $exec->query($selectShow);
            if (mysqli_num_rows($resShow) > 0):?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Show ID</th>
                            <th>Movie</th>
                            <th>Show Time</th>
                            <th>Theater</th>
                            <th>Screen</th>
                            <th>Show Date</th>
                            <th>Show Cost</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($resShow)) : ?>
                            <tr>
                                <td><?= $row['shw_id'] ?></td>
                                <td><?= $row['mv_id'] ?></td>
                                <td><?= $row['shw_time'] ?></td>
                                <td><?= $row['thr_id'] ?></td>
                                <td><?= $row['thr_screen_id'] ?></td>
                                <td><?= $row['shw_date'] ?></td>
                                <td><?= $row['shw_cost'] ?></td>
                                <td><?= $row['shw_status'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <button class="btn btn-primary btn-sm d-none d-sm-inline-block" id="d-button" onclick="window.print()">Download</button>
        </div>

    <?php else : ?>

        <div>
            <h3>403 Forbidden! What the Hell Do you think!</h3>
        </div>

    <?php endif;
}
?>
