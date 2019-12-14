<?php require("../config/autoload.php");


//check session if any Theater is logged in
if (isset($_SESSION['thr_uname'])) {
    unset($_SESSION['thr_uname']);
}

//check session if any user or Admin is logged in
$sec = new Secure;
$sec->checkADSign();


//check for logout

if (isset($_GET['logout'])) {
    session_destroy();
    header("location:../mv-content/login.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Home</title>
</head>
<!--Header-->
<?php //require(SITE_PATH."mv-content/header.php"); ?>
<?php if (isset($_SESSION['success'])) : ?>
    <div class="">
        <h3>
            <?php
            //echo $_SESSION['success'];
            //unset($_SESSION['success']);
            ?>
        </h3>
    </div>
<?php endif ?>

<!--if Admin logged in Successfully-->
<?php require(SITE_PATH . "mv-admin/includes/ad-header.php"); ?>
<?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin') : ?>
    <body class="animated fadeInDown delay-02s" id="page-top">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Earnings (monthly)</span>
                                        </div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>
                                                <?php
                                                $dateToday = date('Y-m-d');
                                                $dateTomorrow = date_format(date_add(date_create($dateToday), date_interval_create_from_date_string("1 day")), 'Y-m-d');
                                                $dateThen = date_format(date_sub(date_create($dateToday), date_interval_create_from_date_string("1 month")), 'Y-m-d');

                                                $allBookMonth = $dbconn->query("select sum(book_pay) as tot_pay from tbl_booking where book_status = 1 and book_date between '$dateThen' and '$dateTomorrow'") or die("Error AllBook");
                                                $resAllBook = mysqli_fetch_assoc($allBookMonth);
                                                print "₹" . $resAllBook['tot_pay'];

                                                ?>
                                            </span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-success py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Earnings (annual)</span>
                                        </div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>
                                                <?php
                                                $dateThen = date_format(date_sub(date_create($dateToday), date_interval_create_from_date_string("1 year")), 'Y-m-d');
                                                $allBookYear = $dbconn->query("select sum(book_pay) as tot_pay_month from tbl_booking where book_status = 1 and book_date > '$dateThen' and book_date <= '$dateTomorrow'");
                                                $resAllBook = mysqli_fetch_assoc($allBookYear);
                                                print "₹" . $resAllBook['tot_pay_month'];
                                                ?>
                                            </span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-info py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Pending Theater Requests</span>
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="text-dark font-weight-bold h5 mb-0 mr-3">
                                                            <span>
                                                                <?php
                                                                $get = new getData;
                                                                echo $get->getNumReqs(2);
                                                                ?>
                                                            </span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-info"
                                                         aria-valuenow="<?= $get->getNumReqs(2) ?>" aria-valuemin="0"
                                                         aria-valuemax="100"
                                                         style="width: <?= $get->getNumReqs(2) ?>%;"><span
                                                                class="sr-only"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-warning py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Pending Movie Requests</span>
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="text-dark font-weight-bold h5 mb-0 mr-3">
                                                            <span>
                                                                <?php
                                                                //$get = new getData;
                                                                echo $get->getNumReqs(1);
                                                                ?>
                                                            </span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-info"
                                                         aria-valuenow="<?= $get->getNumReqs(1) ?>" aria-valuemin="0"
                                                         aria-valuemax="100"
                                                         style="width: <?= $get->getNumReqs(1) ?>%;"><span
                                                                class="sr-only"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 col-xl-8">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-primary font-weight-bold m-0">Earnings Overview</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <?php
                                    $dateThen = date_format(date_sub(date_create($dateToday), date_interval_create_from_date_string("1 year")), 'Y-m-d');
                                    $allBookYear = $dbconn->query("select book_date, sum(book_pay)  as tot_pay_per_month, MONTHNAME(book_date)
                                    as month from tbl_booking where book_status = 1 group by MONTH(book_date) order by year(book_date), month(book_date)") or die("Error All Book Year");
                                    $months = array();
                                    $monthnames = array();
                                    while ($row = mysqli_fetch_assoc($allBookYear)) {
//                                        $months += [$row['book_date'] => $row['tot_pay_per_month']];
                                        array_push($months, $row['tot_pay_per_month']);
                                        array_push($monthnames, $row['month']);
                                    }

                                    //print_r($months);


                                    ?>
                                    <canvas data-bs-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Start&quot;,<?php
                                    $i = 0;
                                    while ($i < count($monthnames)) {
                                        if ($i == count($monthnames) - 1 or count($monthnames) == 1) {
                                            echo "&quot;" . $monthnames[$i] . "&quot;";
                                        } else {
                                            echo "&quot;" . $monthnames[$i] . "&quot;,";
                                        }
                                        $i++;
                                    }
                                    ?>],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Earnings&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;0&quot;,<?php
                                    $i = 0;
                                    while ($i < count($months)) {
                                        if ($i == count($months) - 1) {
                                            echo "&quot;" . (int)$months[$i] . "&quot;";
                                        } else {
                                            echo "&quot;" . (int)$months[$i] . "&quot;,";
                                        }
                                        $i++;
                                    }

                                    ?>],&quot;backgroundColor&quot;:&quot;rgba(78, 115, 223, 0.05)&quot;,&quot;borderColor&quot;:&quot;rgba(78, 115, 223, 1)&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;],&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;]},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}]}}}"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-primary font-weight-bold m-0">Revenue Sources</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas data-bs-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Direct&quot;,&quot;Social&quot;,&quot;Referral&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#1cc88a&quot;,&quot;#36b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;50&quot;,&quot;30&quot;,&quot;15&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{}}}"></canvas>
                                </div>
                                <div
                                        class="text-center small mt-4"><span class="mr-2"><i
                                                class="fas fa-circle text-primary"></i>&nbsp;Direct</span><span
                                            class="mr-2"><i
                                                class="fas fa-circle text-success"></i>&nbsp;Social</span><span
                                            class="mr-2"><i class="fas fa-circle text-info"></i>&nbsp;Refferal</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © AMR Solutions LTD 2019</span></div>
            </div>
        </footer>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-charts.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>-->
    <script src="assets/js/theme.js"></script>
    </body>
<?php endif ?>
</html>
