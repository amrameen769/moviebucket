<?php


class DisplayDet
{
    private $dbconn;

    function __construct()
    {
        $this->dbconn = mysqli_connect('127.0.0.1', 'amrameen769', '7025', 'db_moviebucket') or die("Couldn't connect to database!");
    }

    function returnBooking($detArray)
    {
        $details = array();
        $shw_id = $detArray['shw_id'];
//        print_r($detArray);

        $selectShw = "select * from tbl_showtime where shw_id = $shw_id";
        $resShw = $this->dbconn->query($selectShw);
        if (mysqli_num_rows($resShw) > 0) {
            while ($row = mysqli_fetch_assoc($resShw)) {
                $mv_id = $row['mv_id'];
                $thr_id = $row['thr_id'];
                $thr_screen_id = $row['thr_screen_id'];
            }


            $selectMov = "select mv_name from tbl_movie where mv_id = $mv_id LIMIT 1";
            $selectThr = "select thr_name from tbl_theater where thr_id = $thr_id LIMIT 1";
            $selectScr = "select thr_screen_name from tbl_screens where thr_screen_id = '$thr_screen_id' LIMIT 1";
            $selectShw = "select shw_date,shw_time from tbl_showtime where shw_id=$shw_id";
            $resMov = $this->dbconn->query($selectMov);
            $resThr = $this->dbconn->query($selectThr);
            $resScr = $this->dbconn->query($selectScr);
            $resShw = $this->dbconn->query($selectShw);
            if (mysqli_num_rows($resShw) > 0 and mysqli_num_rows($resMov) > 0 and mysqli_num_rows($resThr) > 0 and mysqli_num_rows($resScr) > 0) {
                $row = mysqli_fetch_assoc($resMov);
                $details += ['mv_name' => $row['mv_name']];
                $row = mysqli_fetch_assoc($resThr);
                $details += ['thr_name' => $row['thr_name']];
                $row = mysqli_fetch_assoc($resScr);
                $details += ['thr_screen_name' => $row['thr_screen_name']];
                $row = mysqli_fetch_assoc($resShw);
                $details += ['shw_date' => $row['shw_date'], 'shw_time' => $row['shw_time']];
            }
        }
        return $details;
    }
}