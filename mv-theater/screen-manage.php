<?php
require("../config/autoload.php");

$sec = new Secure;
$sec -> checkTSign();

require(SITE_PATH."mv-content/header.php");
?>

<html>

<body>
<?php


$thr_uname = $_SESSION['thr_uname'];
echo $thr_uname;
$gd = new getData;
$thr_id = $gd->getTheaterId($thr_uname);



?>
</body>

</html>
