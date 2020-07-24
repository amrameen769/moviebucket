<?php
//Project Path
define("SITE_URL","https://www.moviebucket.com/");
define("SITE_PATH","/opt/lampp/htdocs/moviebucket/");

//Time Zone
date_default_timezone_set('Asia/Kolkata');

//Session
session_start();
require("db.php");
require("classes.php");
require("vendor/autoload.php");
 ?>
