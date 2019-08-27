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
$thr_screens = $gd->getScreenDetails($thr_id);
?>
<div class="highlight-blue"><h3>Screens</h3></div>
<div id = "selectScreens">
    <select name="screen-select" id="screen-select">
        <?php
        $i = 1;
        if($thr_screens > 0) {
            while ($i <= $thr_screens) : ?>
                <option value = "<?=$i?>"><?=$i?></option>
            <?php $i++; endwhile;
        }
        ?>
    </select>
</div>
<?php require(SITE_PATH."mv-content/footer.php");?>
</html>
