<?php
require("../config/autoload.php");

$sec = new Secure;
$sec->checkTSign();

require(SITE_PATH . "mv-content/header.php");
?>

<html>
<title>Profile Settings</title>
<body>
<?php


$thr_uname = $_SESSION['thr_uname'];
$gd = new getData;
$thr_id = $gd->getTheaterId($thr_uname);
$thr_screens = $gd->getScreenDetails($thr_id);
?>
<div class="highlight-blue">
    <div class="container">
        <div class="intro">
            <h2 class="text-center">Profile Settings</h2>
            <p class="text-center">Edit your Profile</p>
        </div>
    </div>
</div>
<div>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <button id ="screens" class="btn nav-link btn-primary" value="<?=$thr_id?>">Screens</button>
        </li>
<!--        <li class="nav-item">-->
<!--            <button id ="details" class="btn nav-link btn-primary" value="--><?//=$thr_id?><!--">Theater Details</button>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--            <button id ="contact" class="btn nav-link btn-primary" value="--><?//=$thr_id?><!--">Contact</button>-->
<!--        </li>-->
    </ul>
</div>
<div id="settings">

</div>

<?php require(SITE_PATH . "mv-content/footer.php"); ?>
</body>
<script>
    document.getElementById('screens').addEventListener('click',function(){ profileSettings(this.id,this.value)});
    document.getElementById('details').addEventListener('click',function(){ profileSettings(this.id,this.value)});
    document.getElementById('contact').addEventListener('click',function(){ profileSettings(this.id,this.value)});
    function profileSettings(settingsid,thrid){
        var xhr = new XMLHttpRequest();
        if(settingsid == 'screens'){
            xhr.open('POST', 'edit-screens.php', true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            let details = "thr_id=" + thrid;
            xhr.onload = function() {
                if(this.readyState == 4){
                    document.getElementById('settings').innerHTML = this.responseText;
                }
            }
            xhr.send(details);
        }
    }

    /*document.getElementById('1').addEventListener("click", function () {
        init(this.id);
    })
    function init(sid) {
        var seat = document.getElementById("name-1").value;
        alert(sid + seat);
    }*/
</script>
</html>
