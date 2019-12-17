<?php

require ("db.php");
class Booking
{
    private $dbconnect;

    function __construct()
    {
        $this->dbconnect = new mysqli($server, $username, $password, $dbname) or die("Couldn't Connect to Database");
    }

    function cancelBooking($shw_id){
        $cancelBooking = "UPDATE tbl_booking set book_status = FALSE where shw_id = '$shw_id' and book_status = 1";
        if($exec->query($cancelBooking)){
            return true;
        } else {
            return false;
        }
    }

    function book($bookDetails)
    {
        ////$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        if (is_array($bookDetails)) {
            $user_id = mysqli_real_escape_string($this->dbconnect, $bookDetails['user_id']);
            $shw_id = mysqli_real_escape_string($this->dbconnect, $bookDetails['shw_id']);
            $book_date = mysqli_real_escape_string($this->dbconnect, $bookDetails['book_date']);
            $book_pay = (double)mysqli_real_escape_string($this->dbconnect, $bookDetails['book_pay']);
            $thr_id = mysqli_real_escape_string($this->dbconnect, $bookDetails['thr_id']);

            $selectedSeats = $bookDetails['selected_seats'];
            foreach ($selectedSeats as $selectedSeat) {
                $screen_seat_id = mysqli_real_escape_string($this->dbconnect, $selectedSeat);
                $insertBooking = "INSERT INTO tbl_booking(user_id, shw_id, thr_id, screen_seat_id, book_date, book_pay, book_status) VALUES ($user_id, $shw_id,$thr_id, '$screen_seat_id','$book_date',$book_pay, TRUE)";
                if (!$this->dbconnect->query($insertBooking)) {
                    return false;
                }
            }
            return true;
        }
    }

    function bookingDetails($user_id)
    {
        $selectBookDetails = "SELECT book_id,screen_seat_id,shw_id,book_date,book_status FROM tbl_booking WHERE user_id='$user_id' ORDER BY book_status DESC";
        $bookingDetails = array();
        $resBookDetails = $this->dbconnect->query($selectBookDetails);
        while ($row = mysqli_fetch_assoc($resBookDetails)) {
            array_push($bookingDetails, $row);
        }
        return $resBookDetails;
    }
}

class Seats
{
    private $dbconnect;

    function __construct()
    {
        $this->dbconnect = new mysqli('127.0.0.1', 'amrameen769', '7025', 'db_moviebucket') or die("Couldn't Connect to Database");
    }

    function seatsNotBooked($thr_screen_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectSeats = "SELECT screen_seat_id FROM tbl_seats WHERE thr_screen_id='$thr_screen_id'";
        $resSeats = $this->dbconnect->query($selectSeats);
        $seatsNotBooked = array();
        if (mysqli_num_rows($resSeats) > 0) {
            while ($row = mysqli_fetch_assoc($resSeats)) {
                array_push($seatsNotBooked, $row['screen_seat_id']);
            }
        }
        return $seatsNotBooked;
    }

    /*function bookSelectedSeats($selectedSeats){
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $flag = true;
        if(is_array($selectedSeats)){
            foreach ($selectedSeats as $selectedSeat){
                $updateBooking = "UPDATE tbl_seats SET seat_book_status = 1 WHERE screen_seat_id = '$selectedSeat' AND seat_book_status = 0";
                if(!$this->dbconnect->query($updateBooking)){
                    $flag = false;
                }
            }
        } else {
            $flag = false;
        }
        return $flag;
    }*/
}

class Screens
{
    private $dbconnect;

    function __construct()
    {
        // $this->dbconnect = new mysqli('127.0.0.1', 'amrameen769', '7025', 'db_moviebucket') or die("Couldn't Connect to Database");
        $this->dbconnect = new mysqli($server, $username, $password, $dbname) or die("Couldn't Connect to Database");
    }

    function editShows($thr_id)
    {
        if (isset($_POST['edit_shw'])) {
            $_SESSION['edit-show-id'] = $_POST['edit_shw'];
            header("location:edit-show.php");
        }
    }

    function checkScreenInitial($thr_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectScreen = "SELECT thr_screen_id FROM tbl_screens WHERE thr_id = '$thr_id' AND thr_screen_status = 1";
        $resScreen = $this->dbconnect->query($selectScreen);
        $gd = new getData;
        $thr_screens = $gd->getScreenDetails($thr_id);
        if (mysqli_num_rows($resScreen) < $thr_screens) {
            return false;
        } else return true;
    }


    function initScreens($thr_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $gd = new getData;
        $thr_screens = $gd->getScreenDetails($thr_id);
        $thr_uname = $gd->getTheaterUname($thr_id);
        $i = 1;
        $flag = '';
        if ($this->checkScreenExist($thr_id)) {
            while ($i <= $thr_screens) {
                $thr_screen_id = $thr_uname . $i;
                $thr_screen_name = "Screen-" . $i;
                $initScreens = "INSERT INTO tbl_screens (thr_id, thr_screen_id, seat_number, thr_screen_name, thr_screen_status) 
                                                VALUES ('$thr_id','$thr_screen_id',0,'$thr_screen_name',0)";
                if ($this->dbconnect->query($initScreens)) {
                    $flag = 1;
                } else {
                    $flag = 0;
                }
                $i++;
            }
            if ($flag == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function returnScreenName($thr_screen_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectScreen = "SELECT thr_screen_name FROM tbl_screens WHERE thr_screen_id = '$thr_screen_id'";
        $resScreen = $this->dbconnect->query($selectScreen);
        if (mysqli_num_rows($resScreen) > 0) {
            $row = mysqli_fetch_assoc($resScreen);
            return $row['thr_screen_name'];
        }
    }

    function returnScreens($thr_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectScreen = "SELECT thr_screen_id,thr_screen_name FROM tbl_screens WHERE thr_id = '$thr_id' AND thr_screen_status = 0";
        $resScreen = $this->dbconnect->query($selectScreen);
        $screenProp = array();
        if (mysqli_num_rows($resScreen) > 0) {
            while ($row = mysqli_fetch_assoc($resScreen)) {
                array_push($screenProp, $row);
            }
            return $screenProp;
        }
    }

    function returnSeats($thr_screen_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectSeats = "SELECT * FROM tbl_seats WHERE thr_screen_id = '$thr_screen_id'";
        $resSeats = $this->dbconnect->query($selectSeats);
        if (mysqli_num_rows($resSeats) > 0) {
            return $resSeats;
        }
    }

    function returnScreenSeats($thr_screen_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectScreen = "SELECT seat_number FROM tbl_screens WHERE thr_screen_id = '$thr_screen_id'";
        $resScreen = $this->dbconnect->query($selectScreen);
        if (mysqli_num_rows($resScreen) > 0) {
            $row = mysqli_fetch_assoc($resScreen);
            return $row['seat_number'];
        }
    }

    function returnScreenId($shw_id)
    {
        //$dbconnect = new mysqli('127.0.0.1', 'amrameen769', '7025', 'db_moviebucket') or die("Couldn't Connect to Database");
        $selectScreen = "SELECT thr_screen_id FROM tbl_showtime WHERE shw_id='$shw_id'";
        $resScreen = $this->dbconnect->query($selectScreen);
        if (mysqli_num_rows($resScreen) > 0) {
            $row = mysqli_fetch_assoc($resScreen);
            return $row['thr_screen_id'];
        }
    }

    function checkScreenExist($thr_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $checkScreen = "SELECT def_screen_id FROM tbl_screens WHERE thr_id = '$thr_id'";
        $resCheckScreen = $this->dbconnect->query($checkScreen);
        if (mysqli_num_rows($resCheckScreen) > 0) {
            return false;
        } else {
            return true;
        }
    }

    function initSeats($thr_screen_id, $seat_number)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $i = 1;
        $flag = 1;
        while ($i <= $seat_number) {
            $screen_seat_id = $thr_screen_id . "-" . $i;
            $initSeat = "INSERT INTO tbl_seats (thr_screen_id,screen_seat_id) 
            VALUES ('$thr_screen_id','$screen_seat_id')";
            if (!$this->dbconnect->query($initSeat)) {
                $flag = 0;
                break;
            }
            if ($flag == 0) {
                return "Seat Initialization Failed";
            }
            if ($i == $seat_number) {
                return "Seats Initialized Succesfully";
            }
            $i++;
        }
    }

    function checkSeatIfBooked($shw_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selBookSeats = "SELECT screen_seat_id FROM tbl_booking WHERE shw_id = '$shw_id'";
        $resBookSeats = $this->dbconnect->query($selBookSeats);
        $seatsBooked = array();
        if (mysqli_num_rows($resBookSeats) > 0) {
            while ($row = mysqli_fetch_assoc($resBookSeats)) {
                array_push($seatsBooked, $row['screen_seat_id']);
            }
        }
        return $seatsBooked;
    }
}


class MovieBook
{
    private $dbconnect;

    function __construct()
    {
        $this->dbconnect = new mysqli($server, $username, $password, $dbname) or die("Couldn't Connect to Database");
        // $this->dbconnect = new mysqli('127.0.0.1', 'amrameen769', '7025', 'db_moviebucket') or die("Couldn't Connect to Database");
    }

    function editMovie($thr_id){
        if(isset($_POST['edit_mov'])){
            $_SESSION['mv_id'] = $_POST['edit_mov'];
            header("location:edit-movie.php");
        }
    }

    function selectMovies()
    {
        $movies = array();
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectMovie = "SELECT mv_id, mv_name,mv_hero,mv_heroine,mv_lang,mv_director,mv_producer,mv_release_date,mv_thumb 
                        FROM tbl_movie WHERE mv_status = 1 AND rq_status = 1 ORDER BY mv_release_date DESC";
        $resSelectMovie = $this->dbconnect->query($selectMovie);
        if (mysqli_num_rows($resSelectMovie) > 0) {
            while ($row = mysqli_fetch_assoc($resSelectMovie)) {
                if (!array_push($movies, $row)) {
                    echo "Array Insertion Unsuccess";
                }
            }
        }
        return $movies;
    }

    function selectMovie($mv_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $row = "";
        $selectMovie = "SELECT mv_name,mv_hero,mv_heroine,mv_lang,mv_director,mv_producer,mv_release_date,mv_thumb
                        FROM tbl_movie WHERE mv_id = '$mv_id' LIMIT 1";
        $resSelectMovie = $this->dbconnect->query($selectMovie);
        if (mysqli_num_rows($resSelectMovie) > 0) {
            $row = mysqli_fetch_assoc($resSelectMovie);
        }
        return $row;
    }

    function selectShows($mv_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectShows = "SELECT * FROM tbl_showtime WHERE mv_id='$mv_id' AND shw_status = 1 ORDER BY shw_date AND shw_time";
        $shows = array();
        $resSelectShows = $this->dbconnect->query($selectShows);
        if (mysqli_num_rows($resSelectShows) > 0) {
            while ($row = mysqli_fetch_assoc($resSelectShows)) {
                array_push($shows, $row);
            }
        }
        return $shows;
    }

    function returnShowCost($shw_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectShowCost = "SELECT shw_cost FROM tbl_showtime WHERE shw_id='$shw_id' LIMIT 1";
        //$shows = array();
        $resSelectShow = $this->dbconnect->query($selectShowCost);
        if (mysqli_num_rows($resSelectShow) > 0) {
            while ($row = mysqli_fetch_assoc($resSelectShow)) {
                return $row['shw_cost'];
            }
        }
    }

    function returnMovie($mv_id)
    {
        $selMovie = "SELECT mv_name FROM tbl_movie where mv_id=$mv_id LIMIT 1";
        $resMovie = $this->dbconnect->query($selMovie);

        if (mysqli_num_rows($resMovie) > 0) {
            $row = mysqli_fetch_assoc($resMovie);
            return $row['mv_name'];
        }
    }

}


class Secure
{
    private $dbconnect;

    function __construct()
    {
        $this->dbconnect = new mysqli($server, $username, $password, $dbname) or die("Couldn't Connect to Database");
        // $this->dbconnect = new mysqli('127.0.0.1', 'amrameen769', '7025', 'db_moviebucket') or die("Couldn't Connect to Database");
    }

    function checkTSign()
    {
        if (isset($_SESSION['thr_uname']) && $_SESSION['user_type'] == 'theater') {
            $_SESSION['success'] = "Logged in Successfully";
            //$_SESSION['root'] = "home.php";
        } //else redirect to login page

        else {
            $_SESSION['msg'] = "You must login first to view this page.";
            unset($_SESSION['success']);
            header("location:../mv-content/login.php");
        }
    }


    function checkUSign()
    {
        if (isset($_SESSION['username']) && $_SESSION['user_type'] == 'enduser') {
            $_SESSION['success'] = "Logged in Successfully";
            //$_SESSION['root'] = "home.php";
        } //else redirect to login page

        else {
            $_SESSION['msg'] = "You must login first to view this page.";
            unset($_SESSION['success']);
            header("location:../mv-content/login.php");
        }
    }

    function checkADSign()
    {
        if (isset($_SESSION['username'], $_SESSION['user_type']) && $_SESSION['user_type'] == "admin") {
            $_SESSION['success'] = "Logged in Successfully";
            //$_SESSION['root'] = "home.php";
        } //else redirect to login page

        else {
            $_SESSION['msg'] = "You must login first to view this page.";
            unset($_SESSION['success']);
            header("location:https://moviebucket.com/mv-content/login.php");
        }
    }
}


class RemoveData
{
    private $dbconnect;

    function __construct()
    {
        $this->dbconnect = new mysqli($server, $username, $password, $dbname) or die("Couldn't Connect to Database");
        // $this->dbconnect = new mysqli('127.0.0.1', 'amrameen769', '7025', 'db_moviebucket') or die("Couldn't Connect to Database");
    }

    function removeShow($thr_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        if (isset($_POST['remove_shw'])) {
            $shw_id = $_POST['remove_shw'];
            //echo "<h1>Removing Data for $shw_id</h1>";
            $delQuery = "UPDATE tbl_showtime SET shw_status = FALSE WHERE shw_id = '$shw_id' AND thr_id='$thr_id'";
            $delBookings = "UPDATE tbl_booking SET book_status = FALSE WHERE shw_id = '$shw_id' AND thr_id = '$thr_id'";
            //$delQueryA = "DELETE FROM tbl_showtime where shw_id = '$shw_id'";
            //$delQueryB = "DELETE FROM tbl_shows where shw_id = '$shw_id' AND thr_id='$thr_id'";
            //$delLogA = mysqli_query($dbconnect,$delQueryA);
            //$delLogB = mysqli_query($dbconnect,$delQueryB);
            if ($this->dbconnect->query($delQuery) === true && $this->dbconnect->query($delBookings)) {
                $_SESSION['remove_shw'] = "Show Time Removed, Bookings Updated.";
            } else {
                echo "Sorry";
            }
        }
        $this->dbconnect->close();
    }

    function removeMovie($thr_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $flag = 1;
        if (isset($_POST['remove_mov'])) {
            $mv_id = $_POST['remove_mov'];
            //echo "<h1>Removing Data for $shw_id</h1>";
            //$delQueryA = "DELETE FROM tbl_movie where mv_id = '$mv_id' AND thr_id = '$thr_id'";
            $delQueryA = "UPDATE tbl_movie SET mv_status = FALSE, rq_status = FALSE WHERE mv_id = '$mv_id' AND thr_id = '$thr_id'";
            //$delLogA = mysqli_query($dbconnect,$delQueryA);
            $selectShow = "SELECT shw_id FROM tbl_showtime WHERE mv_id = $mv_id";
            $resShow = $this->dbconnect->query($selectShow);
            if (mysqli_num_rows($resShow)) {
                while ($rowShow = mysqli_fetch_assoc($resShow)) {
                    $shw_id = $rowShow['shw_id'];
                    $removeShow = "UPDATE tbl_showtime SET shw_status = FALSE WHERE shw_id = $shw_id";
                    if (!$this->dbconnect->query($removeShow)) {
                        $flag = 0;
                    }
                }
            }
            if ($this->dbconnect->query($delQueryA) === TRUE && $flag == 1) {
                $_SESSION['remove_mov'] = "Movie Removed, Shows Updated";
            } else {
                $_SESSION['remove_mov'] = "You are Not authorised to remove this Movie";
            }
        }
        $this->dbconnect->close();
    }
}

class StoreData
{
    public $shw_id;

    function putShow($value)
    {
        $this->shw_id = $value;
    }

    function getShow()
    {
        return $this->shw_id;
    }
}

class getData
{
    private $dbconnect;

    function __construct()
    {
        $this->dbconnect = new mysqli($server, $username, $password, $dbname) or die("Couldn't Connect to Database");
        // $this->dbconnect = new mysqli('127.0.0.1', 'amrameen769', '7025', 'db_moviebucket') or die("Couldn't Connect to Database");
    }

    public $thr_name;
    public $thr_uname;

    function getTheater($thr_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectTheater = "SELECT thr_name from tbl_theater WHERE thr_id='$thr_id'";
        $results = $exec->query($selectTheater);
        if (mysqli_num_rows($results) > 0) {
            if ($row = mysqli_fetch_assoc($results)) {
                $this->thr_name = $row['thr_name'];
            }
        }
        return $this->thr_name;
    }

    function returnShow($shw_id)
    {
        $selShow = $this->dbconnect->query("select * from tbl_showtime where shw_id = '$shw_id' LIMIT 1");
        if(mysqli_num_rows($selShow) > 0){
            return $row = mysqli_fetch_assoc($selShow);
        }
    }

    function getTheaterUname($thr_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectTheater = "SELECT thr_uname from tbl_theater WHERE thr_id='$thr_id'";
        $results = $this->dbconnect->query($selectTheater);
        if (mysqli_num_rows($results) > 0) {
            if ($row = mysqli_fetch_assoc($results)) {
                $this->thr_uname = $row['thr_uname'];
            }
        }
        return $this->thr_uname;
    }

    function getScreenDetails($thr_id)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectScreenNo = "SELECT thr_screens FROM tbl_theater WHERE thr_id = $thr_id LIMIT 1";
        $resScreen = $this->dbconnect->query($selectScreenNo);
        if (mysqli_num_rows($resScreen) > 0) {
            $row = mysqli_fetch_assoc($resScreen);
            return $row['thr_screens'];
        }
    }

    function getTheaterId($thr_name)
    {
        $thr_id = 0;
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selQuery = "SELECT thr_id FROM tbl_theater WHERE thr_uname = '$thr_name'";
        $results = $exec->query($selQuery);
        if (mysqli_num_rows($results) > 0) {
            $row = mysqli_fetch_assoc($results);
            $thr_id = $row['thr_id'];
        }
        return $thr_id;
    }

    private $reqNo;

    function getNumReqs($n)
    {
        $numThr = 0;
        $numMov = 0;
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectThrRequests = "SELECT thr_status FROM tbl_theater WHERE thr_status = FALSE";
        $selectMovRequests = "SELECT rq_status FROM tbl_movie WHERE rq_status = FALSE";
        $resThr = $this->dbconnect->query($selectThrRequests);
        $resMov = $this->dbconnect->query($selectMovRequests);
        $numMov = mysqli_num_rows($resMov);
        $numThr = mysqli_num_rows($resThr);
        $this->reqNo = $numMov + $numThr;
        if ($n == 1) {
            return $numMov;
        } elseif ($n == 2) {
            return $numThr;
        } elseif ($n == 3) {
            return $this->reqNo;
        }
    }

    function returnUserID($username)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectUserID = "SELECT user_id FROM tbl_user WHERE user_uname='$username' LIMIT 1";
        $resSelectUserID = $this->dbconnect->query($selectUserID);
        if (mysqli_num_rows($resSelectUserID) > 0) {
            $row = mysqli_fetch_assoc($resSelectUserID);
            return $row['user_id'];
        }
    }

    function returnUserMail($username)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectUserID = "SELECT user_mail FROM tbl_user WHERE user_uname='$username' LIMIT 1";
        $resSelectUserID = $this->dbconnect->query($selectUserID);
        if (mysqli_num_rows($resSelectUserID) > 0) {
            $row = mysqli_fetch_assoc($resSelectUserID);
            return $row['user_mail'];
        }
    }

    function returnUserDetails($username)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectUserDetails = "SELECT user_mail,user_id,user_name,user_phone FROM tbl_user WHERE user_uname='$username' LIMIT 1";
        $resSelectUserID = $this->dbconnect->query($selectUserDetails);
        if (mysqli_num_rows($resSelectUserID) > 0) {
            $row = mysqli_fetch_assoc($resSelectUserID);
            return $row;
        }
    }

    function returnUsername($userid)
    {
        //$dbconnect = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectUserDetails = "SELECT user_name FROM tbl_user WHERE user_id='$userid' LIMIT 1";
        $resSelectUserID = $this->dbconnect->query($selectUserDetails);
        if (mysqli_num_rows($resSelectUserID) > 0) {
            $row = mysqli_fetch_assoc($resSelectUserID);
            return $row['user_name'];
        }
    }

    function selectReviews($mv_id){
        $reviewDetails = array();
        $eachReview = array();
        $mb = new MovieBook();
        $movieDetails = $mb->selectMovie($mv_id);
        $selReview = $this->dbconnect->query("select * from tbl_review where mv_id='$mv_id'");
        //print_r($selReview);
        if(mysqli_num_rows($selReview) > 0){
            while($row = mysqli_fetch_assoc($selReview)){
                $eachReview += ["user_name" => $this->returnUsername($row['user_id'])];
                $eachReview += ["mv_name" => $movieDetails['mv_name']];
                $eachReview += ["review" => $row['mv_review']];
                $eachReview += ["rating" => $row['mv_rating']];
                $eachReview += ["date" => $row['review_date']];
                array_push($reviewDetails,$eachReview);
                $eachReview = [];
            }
        }
        return $reviewDetails;
    }
}


