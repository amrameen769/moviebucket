<?php
//Project Path
define("SITE_URL","https://moviebucket-app.herokuapp.com/");
define("SITE_PATH","/app/");

//Time Zone
date_default_timezone_set('Asia/Kolkata');

//Session
session_start();
require("db.php");
require("classes.php");
require("vendor/autoload.php");
 ?>
