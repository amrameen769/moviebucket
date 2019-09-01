
<?php
class Screens{
    function checkScreenInitial($thr_id){
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectScreen = "SELECT thr_screen_id FROM tbl_screens WHERE thr_id = '$thr_id' AND thr_screen_status = 1";
        $resScreen = $dbconn->query($selectScreen);
        $gd = new getData;
        $thr_screens = $gd->getScreenDetails($thr_id);
        if(mysqli_num_rows($resScreen) < $thr_screens){
            return false;
        } else return true;
    }

    function initScreens($thr_id){
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $gd = new getData;
        $thr_screens = $gd->getScreenDetails($thr_id);
        $thr_uname = $gd->getTheaterUname($thr_id);
        $i = 1;
        $flag = '';
        if($this->checkScreenExist($thr_id)){
            while($i <= $thr_screens){
                $thr_screen_id = $thr_uname.$i;
                $thr_screen_name = "Screen-".$i;
                $initScreens = "INSERT INTO tbl_screens (thr_id, thr_screen_id, seat_number, thr_screen_name, thr_screen_status) 
                                                VALUES ('$thr_id','$thr_screen_id',0,'$thr_screen_name',0)";
                if($dbconn->query($initScreens)){
                    $flag = 1;
                } else {
                    $flag = 0;
                }
                $i++;
            }
            if($flag == 1){
                return true;
            } else {
                return false;
            }
        } else{
            return false;
        }
    }

    function returnScreenName($thr_screen_id){
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectScreen = "SELECT thr_screen_name FROM tbl_screens WHERE thr_screen_id = '$thr_screen_id'";
        $resScreen = $dbconn->query($selectScreen);
        if(mysqli_num_rows($resScreen) > 0){
            $row = mysqli_fetch_assoc($resScreen);
            return $row['thr_screen_name'];
        }
    }

    function returnScreens($thr_id){
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectScreen = "SELECT thr_screen_id,thr_screen_name FROM tbl_screens WHERE thr_id = '$thr_id' AND thr_screen_status = 0";
        $resScreen = $dbconn->query($selectScreen);
        $screenProp = array();
        if(mysqli_num_rows($resScreen) > 0){
            while($row = mysqli_fetch_assoc($resScreen)){
                array_push($screenProp,$row);
            }
            return $screenProp;
        }
    }

    function returnSeats($thr_screen_id){
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectSeats = "SELECT * FROM tbl_seats WHERE thr_screen_id = '$thr_screen_id'";
        $resSeats = $dbconn->query($selectSeats);
        if(mysqli_num_rows($resSeats) > 0){
            return $resSeats;
        }
    }

    function returnScreenSeats($thr_screen_id){
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectScreen = "SELECT seat_number FROM tbl_screens WHERE thr_screen_id = '$thr_screen_id'";
        $resScreen = $dbconn->query($selectScreen);
        if(mysqli_num_rows($resScreen) > 0){
            $row = mysqli_fetch_assoc($resScreen);
            return $row['seat_number'];
        }
    }

    function returnScreenId($shw_id){
        $dbconn = new mysqli('127.0.0.1', 'amrameen769', '7025', 'db_moviebucket') or die("Couldn't Connect to Database");
        $selectScreen ="SELECT thr_screen_id FROM tbl_showtime WHERE shw_id='$shw_id'";
        $resScreen = $dbconn->query($selectScreen);
        if(mysqli_num_rows($resScreen) > 0){
            $row = mysqli_fetch_assoc($resScreen);
            return $row['thr_screen_id'];
        }
    }

    function checkScreenExist($thr_id){
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $checkScreen = "SELECT def_screen_id FROM tbl_screens WHERE thr_id = '$thr_id'";
        $resCheckScreen = $dbconn->query($checkScreen);
        if(mysqli_num_rows($resCheckScreen) > 0){
            return false;
        } else {
            return true;
        }
    }

    function initSeats($thr_screen_id,$seat_number){
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $i = 1;
        $flag = 1;
        while($i<=$seat_number){
            $screen_seat_id = $thr_screen_id."-".$i;
            $initSeat = "INSERT INTO tbl_seats (thr_screen_id,screen_seat_id, seat_book_status) 
            VALUES ('$thr_screen_id','$screen_seat_id',false)";
            if(!$dbconn->query($initSeat)){
                $flag = 0;
                break;
            }
            if($flag == 0){
                return "Seat Initialization Failed";
            }
            if($i == $seat_number){
                return "Seats Initialized Succesfully";
            }
            $i++;
        }
    }
}


class MovieBook{
    function selectMovies(){
        $movies = array();
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectMovie = "SELECT mv_id, mv_name,mv_hero,mv_heroine,mv_lang,mv_director,mv_producer,mv_release_date,mv_thumb 
                        FROM tbl_movie WHERE mv_status = 1 AND rq_status = 1 ORDER BY mv_release_date DESC";
        $resSelectMovie = $dbconn -> query($selectMovie);
        if(mysqli_num_rows($resSelectMovie) > 0){
            while($row = mysqli_fetch_assoc($resSelectMovie)){
                if(!array_push($movies,$row)){echo "Array Insertion Unsuccess";}
            }
        }
        return $movies;
    }

    function selectMovie($mv_id){
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $row = "";
        $selectMovie = "SELECT mv_name,mv_hero,mv_heroine,mv_lang,mv_director,mv_producer,mv_release_date,mv_thumb
                        FROM tbl_movie WHERE mv_id = '$mv_id' LIMIT 1";
        $resSelectMovie = $dbconn -> query($selectMovie);
        if(mysqli_num_rows($resSelectMovie) > 0){
            $row = mysqli_fetch_assoc($resSelectMovie);
        }
        return $row;
    }

    function selectShows($mv_id){
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectShows = "SELECT * FROM tbl_showtime WHERE mv_id='$mv_id' ORDER BY shw_date AND shw_time";
        $shows = array();
        $resSelectShows = $dbconn -> query($selectShows);
        if(mysqli_num_rows($resSelectShows) > 0){
            while($row = mysqli_fetch_assoc($resSelectShows)){
                array_push($shows,$row);
            }
        }
        return $shows;
    }
}



class Secure{
  function checkTSign(){
    if(isset($_SESSION['thr_uname']) && $_SESSION['user_type'] == 'theater'){
    $_SESSION['success'] = "Logged in Successfully";
    //$_SESSION['root'] = "home.php";
    }

    //else redirect to login page

    else{
    $_SESSION['msg'] = "You must login first to view this page.";
    unset($_SESSION['success']);
    header("location:../mv-content/login.php");
    }
  }


  function checkUSign(){
    if(isset($_SESSION['username']) && $_SESSION['user_type'] == 'enduser'){
    $_SESSION['success'] = "Logged in Successfully";
    //$_SESSION['root'] = "home.php";
    }

    //else redirect to login page

    else{
    $_SESSION['msg'] = "You must login first to view this page.";
    unset($_SESSION['success']);
    header("location:../mv-content/login.php");
    }
  }
  function checkADSign(){
      if(isset($_SESSION['username'],$_SESSION['user_type']) && $_SESSION['user_type'] == "admin"){
              $_SESSION['success'] = "Logged in Successfully";
              //$_SESSION['root'] = "home.php";
      }

      //else redirect to login page

      else{
          $_SESSION['msg'] = "You must login first to view this page.";
          unset($_SESSION['success']);
          header("location:../mv-content/login.php");
      }
  }
}


class RemoveData{
  function removeShow($thr_id){
    $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
    if(isset($_POST['remove_shw'])){
      $shw_id = $_POST['remove_shw'];
      //echo "<h1>Removing Data for $shw_id</h1>";
      $delQuery = "UPDATE tbl_showtime SET shw_status = FALSE WHERE shw_id = '$shw_id' AND thr_id='$thr_id'";
        //$delQueryA = "DELETE FROM tbl_showtime where shw_id = '$shw_id'";
        //$delQueryB = "DELETE FROM tbl_shows where shw_id = '$shw_id' AND thr_id='$thr_id'";
        //$delLogA = mysqli_query($dbconn,$delQueryA);
      //$delLogB = mysqli_query($dbconn,$delQueryB);
      if($dbconn -> query($delQuery) === true){
        $_SESSION['remove_shw'] = "Show Time Removed";
      }
      else{
          echo "Sorry";
      }
    }
    $dbconn -> close();
  }

    function removeMovie($thr_id){
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $flag = 1;
        if(isset($_POST['remove_mov'])){
            $mv_id = $_POST['remove_mov'];
            //echo "<h1>Removing Data for $shw_id</h1>";
            //$delQueryA = "DELETE FROM tbl_movie where mv_id = '$mv_id' AND thr_id = '$thr_id'";
            $delQueryA = "UPDATE tbl_movie SET mv_status = FALSE, rq_status = FALSE WHERE mv_id = '$mv_id' AND thr_id = '$thr_id'";
            //$delLogA = mysqli_query($dbconn,$delQueryA);
            $selectShow = "SELECT shw_id FROM tbl_showtime WHERE mv_id = $mv_id";
            $resShow = $dbconn->query($selectShow);
            if(mysqli_num_rows($resShow)){
                while($rowShow = mysqli_fetch_assoc($resShow)){
                    $shw_id = $rowShow['shw_id'];
                    $removeShow = "UPDATE tbl_showtime SET shw_status = FALSE WHERE shw_id = $shw_id";
                    if(!$dbconn->query($removeShow)){
                        $flag = 0;
                    }
                }
            }
            if($dbconn -> query($delQueryA) === TRUE && $flag == 1){
                $_SESSION['remove_mov'] = "Movie Removed, Shows Updated";
            }
            else{
                $_SESSION['remove_mov'] = "You are Not authorised to remove this Movie";
            }
        }
        $dbconn -> close();
    }
}

class StoreData{
    public $shw_id;
    function putShow($value){
        $this->shw_id = $value;
    }
    function getShow(){
        return $this->shw_id;
    }
}

class getData{
    public $thr_name;
    public $thr_uname;
    function getTheater($thr_id){
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectTheater = "SELECT thr_name from tbl_theater WHERE thr_id='$thr_id'";
        $results = $dbconn->query($selectTheater);
        if(mysqli_num_rows($results) > 0){
            if($row = mysqli_fetch_assoc($results)){
                $this->thr_name = $row['thr_name'];
            }
        }
        return $this->thr_name;
    }

    function getTheaterUname($thr_id){
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectTheater = "SELECT thr_uname from tbl_theater WHERE thr_id='$thr_id'";
        $results = $dbconn->query($selectTheater);
        if(mysqli_num_rows($results) > 0){
            if($row = mysqli_fetch_assoc($results)){
                $this->thr_uname = $row['thr_uname'];
            }
        }
        return $this->thr_uname;
    }

    function getScreenDetails($thr_id){
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectScreenNo = "SELECT thr_screens FROM tbl_theater WHERE thr_id = $thr_id LIMIT 1";
        $resScreen = $dbconn->query($selectScreenNo);
        if(mysqli_num_rows($resScreen) > 0){
            $row = mysqli_fetch_assoc($resScreen);
            return $row['thr_screens'];
        }
    }

    function getTheaterId($thr_name){
        $thr_id = 0;
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selQuery = "SELECT thr_id FROM tbl_theater WHERE thr_uname = '$thr_name'";
        $results = mysqli_query($dbconn, $selQuery);
        if (mysqli_num_rows($results) > 0) {
            $row = mysqli_fetch_assoc($results);
            $thr_id = $row['thr_id'];
        }
        return $thr_id;
    }
    private $reqNo;
    function getNumReqs($n){
        $numThr = 0;
        $numMov = 0;
        $dbconn = new mysqli('127.0.0.1','amrameen769','7025','db_moviebucket') or die("Couldn't Connect to Database");
        $selectThrRequests = "SELECT thr_status FROM tbl_theater WHERE thr_status = FALSE";
        $selectMovRequests = "SELECT rq_status FROM tbl_movie WHERE rq_status = FALSE";
        $resThr = $dbconn->query($selectThrRequests);
        $resMov = $dbconn->query($selectMovRequests);
        $numMov = mysqli_num_rows($resMov);
        $numThr = mysqli_num_rows($resThr);
        $this->reqNo = $numMov + $numThr;
        if($n == 1){
            return $numMov;
        }
        elseif ($n == 2){
            return $numThr;
        }
        elseif ($n == 3){
            return $this->reqNo;
        }
    }
}


