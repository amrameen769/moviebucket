<?php require("../config/autoload.php");


$sec = new Secure;
$sec->checkTSign();

$thr_uname = $_SESSION['thr_uname'];

if(isset($_SESSION['edit-show-id'])){
    echo $_SESSION['edit-show-id'];
}