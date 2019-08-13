#!C:\Program Files (x86)\Microsoft Visual Studio\Shared\Python37_64\python.exe
print("Content-type: text/html\n")
print()
print("Hello World")


$selectThrRequests = "SELECT thr_status FROM tbl_theater WHERE thr_status = 0";
        $selectMovRequests = "SELECT rq_status FROM tbl_movie WHERE rq_status = 0";
        $resThr = $dbconn->$selectThrRequests;
        $resMov = $dbconn->$selectMovRequests;
        if($numMov = mysqli_num_rows($resMov) > 0 || $numThr = mysqli_num_rows($resThr) > 0 ){
            $this->reqNo = $numMov + $numThr;
        }