<?php
  $dbname = "jw7EiqcSVy";
  $server = "remotemysql.com";
  $username = "jw7EiqcSVy";
  $password = "b67MLToyew";
  $dbconn = mysqli_connect($server,$username,$password,$dbname) or die("Couldn't Connect to Database");
  $exec = new mysqli($server,$username,$password,$dbname);
