<?php
  $dbname = "db_moviebucket";
  $server = "127.0.0.1";
  $username = "amrameen769";
  $password = "7025";
  $dbconn = mysqli_connect($server,$username,$password,$dbname) or die("Couldn't Connect to Database");
  $exec = new mysqli($server,$username,$password,$dbname);
