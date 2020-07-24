<?php require("../config/autoload.php");

//check session if any Theater is logged in
if (isset($_SESSION['thr_uname'])) {
    unset($_SESSION['thr_uname']);
}

//check session if any user is logged in

$sec = new Secure;
$sec->checkUSign();

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
<?php require(SITE_PATH . "mv-content/header.php"); ?>
<body id="book-container">
<?php if (isset($_SESSION['success'])) : ?>
    <div class="jumbotron">
        <h3>
            Welcome, <?= $_SESSION['username'] ?>
        </h3>
    </div>
<?php endif ?>

<!--if user logged in Successfully-->
<?php if (isset($_SESSION['username'])) : ?>
    <!--<div class="jumbotron"><h3>Welcome <strong><$session['username']></strong></h3></div>-->
    <?php if (isset($_POST['search-mv'])) : ?>
        <span class="heading"> Search Matches:</span>
        <form action="book-movie.php" method="post">
            <div class="row row-margin">
                <?php
                $searchTerm = $_POST['search-movie'];
                if (empty($searchTerm)) {
                    echo "<p>No Movies Found</p>";
                } else {
                    $selectMovie = $dbconn->query("select * from tbl_movie where mv_name like '%$searchTerm%' limit 5");
                    if (mysqli_num_rows($selectMovie) > 0) {
                        while ($row = mysqli_fetch_assoc($selectMovie)): ?>
                            <div class="col-md-6 col-xl-auto mb-4">
                                <div class="card shadow border-left-primary py-2 width-set">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col mr-2">
                                                <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                                <span>
                                                    <img src="<?= SITE_URL ?>mv-theater/mv-thumb/<?= $row['mv_thumb'] ?>"
                                                         height="100px" alt="mv-thumb.jpg">
                                                </span>
                                                </div>
                                                <div class="text-dark font-weight-bold h5 mb-0">
                                                    <span><?= $row['mv_name'] ?></span></div>
                                                <button type="submit" class="btn btn-primary" name="btn-mov-book"
                                                        value="<?= $row['mv_id'] ?>">Read More...
                                                </button>
                                                <div class="col-auto"><i
                                                            class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile ?>
                        <?php
                    }
                }
                ?>
            </div>
        </form>
    <?php endif ?>

    <form action="book-movie.php" method="post">
        <span class="heading"> Available Movies</span>
        <div class="row row-margin">
            <?php
            $i = 1;
            $mb = new MovieBook;
            $movies = $mb->selectMovies();
            if (is_array($movies)) {
                foreach ($movies as $movie) {
                    if (is_array($movie)) : ?>
                        <div class="col-md-6 col-xl-auto mb-4">
                            <div class="card shadow border-left-primary py-2 width-set">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                                <span>
                                                    <img src="<?= SITE_URL ?>mv-theater/mv-thumb/<?= $movie['mv_thumb'] ?>"
                                                         height="100px" alt="mv-thumb.jpg">
                                                </span>
                                            </div>
                                            <div class="text-dark font-weight-bold h5 mb-0">
                                                <span><?= $movie['mv_name'] ?></span></div>
                                            <button type="submit" class="btn btn-primary" name="btn-mov-book"
                                                    value="<?= $movie['mv_id'] ?>">Read More...
                                            </button>
                                            <div class="col-auto"><i
                                                        class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif;
                }
            }
            ?>
        </div>
    </form>
<?php endif ?>
<?php require(SITE_PATH . "mv-content/footer.php"); ?>
</body>
</html>
