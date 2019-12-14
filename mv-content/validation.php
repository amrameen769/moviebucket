<?php

class Validation
{
    private $conn;
    private $errors = array();
    function __construct()
    {
        $this->conn = new mysqli('127.0.0.1', 'amrameen769', '7025', 'db_moviebucket') or die("Connection Error");
    }

    function validate($formArray)
    {

        if (is_array($formArray) && !empty($formArray)) {
            foreach ($formArray as $field => $value) {
                if ($field == "username") {
                    $this->credentialChecker($field, $value);
                }
                if ($field == "password") {
                    $this->credentialChecker($field, $value);
                }
                if($field == "email"){
                    $this->credentialChecker($field,$value);
                }
            }
        }
        return $this->errors;
    }

    private function credentialChecker($field, $value)
    {
        if ($field == "username") {
            $upper = preg_match('@[A-Z]@',$value);
            $spec = preg_match('@[^\w]@',$value);
            if ($upper || $spec || strlen($value) <= 5) {
                array_push($this->errors, "Username should not contain uppercase letters or special characters or whitespaces and should be at least 6 characters long");
            }
        }

        if ($field == "password") {
            $upper = preg_match('@[A-Z]@',$value);
            $lower = preg_match('@[a-z]@',$value);
            $num = preg_match('@[0-9]@',$value);
            $spec = preg_match('@[^\w]@',$value);
            if (!$upper || !$lower || !$num || !$spec || strlen($value) <= 5) {
                array_push($this->errors,"Password should contain at least 1 Uppercase, 1 Lowercase , 1 Number, 1 Special Character and Length needs to be more than 6 characters");
            }
        }

        if($field == "email"){
            if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
                array_push($this->errors,"Enter a Valid Email");
            }
        }
    }

    function checkShowInterval($thr_id, $thr_screen_id, $timeOfNewShow, $dateOfNewShow){
        $dateTimeOfNewShow = $dateOfNewShow." ".$timeOfNewShow;
            $selectTimeDifferenceBef = $this->conn->query("SELECT TIMEDIFF('$dateTimeOfNewShow', (SELECT concat(tbl_showtime.shw_date,' ', tbl_showtime.shw_time) from tbl_showtime 
            WHERE shw_id =  (SELECT shw_id from tbl_showtime where shw_status = 1 and thr_screen_id = '$thr_screen_id' AND shw_date = '$dateOfNewShow' AND shw_time < '$timeOfNewShow' 
            ORDER BY shw_time DESC LIMIT 1))) as timeInterval")
        or die("Error Selecting Time Difference");

        $selectTimeDifferenceAft = $this->conn->query("SELECT TIMEDIFF((SELECT concat(tbl_showtime.shw_date,' ', tbl_showtime.shw_time) from tbl_showtime 
        WHERE shw_id =  (SELECT shw_id from tbl_showtime where shw_status = 1 and thr_screen_id = '$thr_screen_id' AND shw_date = '$dateOfNewShow' AND shw_time > '$timeOfNewShow' 
        ORDER BY shw_time LIMIT 1)),'$dateTimeOfNewShow') as timeInterval")
        or die("Error Selecting Time Difference");

        $bef = mysqli_fetch_assoc($selectTimeDifferenceBef);
        $Aft = mysqli_fetch_assoc($selectTimeDifferenceAft);
        return $intervalArray = array("bef"=>$bef['timeInterval'], "aft"=>$Aft['timeInterval']);

    }
}