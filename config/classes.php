
<?php
class Secure{
  function checkTSign(){
    if(isset($_SESSION['thr_name']) && $_SESSION['user_type'] == 'theater'){
    $_SESSION['success'] = "Logged in Successfully";
    //$_SESSION['root'] = "home.php";
    }

    //else redirect to login page

    else{
    $_SESSION['msg'] = "You must login first to view this page.";
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
      $delQueryA = "UPDATE tbl_showtime SET shw_status = FALSE WHERE shw_id = '$shw_id'";
      $delQueryB = "UPDATE tbl_shows SET shw_status = FALSE WHERE shw_id = '$shw_id' AND thr_id='$thr_id'";
        //$delQueryA = "DELETE FROM tbl_showtime where shw_id = '$shw_id'";
        //$delQueryB = "DELETE FROM tbl_shows where shw_id = '$shw_id' AND thr_id='$thr_id'";
        //$delLogA = mysqli_query($dbconn,$delQueryA);
      //$delLogB = mysqli_query($dbconn,$delQueryB);
      if($dbconn -> query($delQueryA) === true && $dbconn -> query($delQueryB) === true){
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
        if(isset($_POST['remove_mov'])){
            $mv_id = $_POST['remove_mov'];
            //echo "<h1>Removing Data for $shw_id</h1>";
            //$delQueryA = "DELETE FROM tbl_movie where mv_id = '$mv_id' AND thr_id = '$thr_id'";
            $delQueryA = "UPDATE tbl_movie SET mv_status = FALSE, rq_status = FALSE WHERE mv_id = '$mv_id' AND thr_id = '$thr_id'";
            //$delLogA = mysqli_query($dbconn,$delQueryA);
            if($dbconn -> query($delQueryA) === true){
                $_SESSION['remove_mov'] = "Movie Removed";
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


