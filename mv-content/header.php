<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= SITE_URL ?>mv-includes/images/mvbucket.ico" rel="icon">

    <!-- CSS and JS -->

    <link rel="stylesheet" href="<?= SITE_URL ?>mv-includes/fonts/webfontkit/stylesheet.css">
    <script src="<?= SITE_URL ?>mv-includes/bootstrap/jquery/jquery.min.js"></script>
    <script src="<?= SITE_URL ?>mv-includes/bootstrap/jquery/popper.min.js"></script>
    <link rel="stylesheet" href="<?= SITE_URL ?>mv-includes/bootstrap/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="mv-includes/bootstrap/css/bootstrap.min.css">-->
    <script src="<?= SITE_URL ?>mv-includes/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= SITE_URL ?>mv-includes/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= SITE_URL ?>mv-includes/css/login.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>mv-includes/css/animate.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>mv-includes/css/master.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>mv-includes/css/style.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>mv-includes/fontawesome/css/all.css">
    <script src="<?= SITE_URL ?>mv-includes/fontawesome/js/all.js"></script>
    <link rel="stylesheet" href="<?= SITE_URL ?>mv-includes/fonts/icon.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>mv-includes/css/responsive.css">
    <script src="<?= SITE_URL ?>mv-admin/assets/js/theme.js"></script>
    <script src="<?= SITE_URL ?>mv-includes/bootstrap/jquery/jquery.easing.js"></script>
    <script src="<?= SITE_URL ?>mv-includes/js/script.js"></script>
    <link rel="stylesheet" href="<?= SITE_URL ?>mv-includes/scss/seat-style.css">
    <script src="<?= SITE_URL ?>mv-includes/js/sass.dart.js"></script>
    <link rel="stylesheet/less" href="<?= SITE_URL ?>mv-includes/less/styles.css">
    <script src="<?= SITE_URL ?>mv-includes/js/payment.js"></script>

    <!--<script>
        less = {
            env: "development",
            async: false,
            fileAsync: false,
            poll: 1000,
            functions: {},
            dumpLineNumbers: "comments",
            relativeUrls: false,
            rootpath: ":/a.com/"
        };
    </script>-->
    <script src="<?= SITE_URL ?>mv-includes/js/less.js"></script>
    <style>
        .navbar-brand img {
            height: 40px;
            width: 40px;
            margin-right: 10px;
        }
    </style>
</head>
<body class="animated fadeInDown delay-02s">

<!-- Navigation Bar -->
<header class="sticky-top">
    <nav id="nav-bar" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="http://www.moviebucket.com"><img
                    src="<?= SITE_URL ?>mv-includes/images/mvbucket.ico" alt="MovieBucket">MovieBucket.com</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="
          <?php
                    $gd = new getData();
                    if (isset($_SESSION['user_type'])) {
                        if ($_SESSION['user_type'] == 'enduser') {
                            echo SITE_URL . "mv-enduser/home.php";
                        } elseif ($_SESSION['user_type'] == 'admin') {
                            echo SITE_URL . "mv-admin/home.php";
                        } elseif ($_SESSION['user_type'] == 'theater') {
                            echo SITE_URL . "mv-theater/home.php";
                        }
                    } ?>">Home<span class="sr-only">(current)</span></a>
                </li>
                <!--<li class="nav-item">
                  <a class="nav-link" href="#">Movies</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Bookings
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </li>-->
                <?php if (isset($_SESSION['user_type'])) : ?>
                <?php if ($_SESSION['user_type'] == "theater") : ?>

            </ul>
            <div class="nav-item dropdown">
                <button class="btn btn-primary user dropdown-toggle" data-toggle="dropdown">
                    <strong><?php
                        $thr_uname = $_SESSION['thr_uname'];
                        $thr_id = $gd->getTheaterId($thr_uname);
                        $thr_name = $gd->getTheater($thr_id);
                        echo $thr_name;
                        ?></strong></h3></button>
                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                    <a class="dropdown-item" role="presentation" href="<?= SITE_URL ?>mv-theater/profile.php"><i
                                class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>
                    <!--<a class="dropdown-item" role="presentation" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                    <a class="dropdown-item" role="presentation" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>-->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" role="presentation" href="<?= SITE_URL ?>mv-theater/home.php?logout='1'"><i
                                class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                </div>
            </div>
            <?php elseif ($_SESSION['user_type'] == "admin") : ?>
                <div class="nav-item dropdown">
                    <button class="btn btn-primary user dropdown-toggle" data-toggle="dropdown">
                        <strong><?= $_SESSION['username'] ?></strong></h3></button>
                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                        <!--<a class="dropdown-item" role="presentation" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>
                        <a class="dropdown-item" role="presentation" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                        <a class="dropdown-item" role="presentation" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>-->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" role="presentation" href="<?= SITE_URL ?>mv-admin/home.php?logout='1'"><i
                                    class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                    </div>
                </div>
            <?php elseif ($_SESSION['user_type'] == "enduser") : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_URL ?>mv-enduser/cancel-tickets.php">Bookings</a>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="<?=SITE_URL."mv-enduser/home.php"?>" method="post">
                    <input class="form-control mr-sm-2" name="search-movie" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search-mv">Search</button>
                </form>
                <div class="nav-item dropdown">
                    <button class="btn btn-primary user dropdown-toggle" data-toggle="dropdown">
                        <strong><?php
                            $username = $_SESSION['username'];
                            $userDet = $gd->returnUserDetails($username);
                            echo $userDet['user_name'];
                            ?></strong></h3></button>
                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                        <a class="dropdown-item" role="presentation"
                           href="<?= SITE_URL ?>mv-enduser/cancel-tickets.php"><i
                                    class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Bookings</a>
                        <!--a class="dropdown-item" role="presentation" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                        <a class="dropdown-item" role="presentation" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>-->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" role="presentation"
                           href="<?= SITE_URL ?>mv-enduser/home.php?logout='1'"><i
                                    class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                    </div>
                </div>
            <?php endif ?>
            <?php endif ?>

        </div>
    </nav>
</header>
