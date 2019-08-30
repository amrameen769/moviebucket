<?php require("../../config/autoload.php");

$sec = new Secure;
$sec->checkUSign();

require(SITE_PATH . "mv-content/header.php");

echo $_POST['shw_id'];
?>

<head>
    <link rel="stylesheet" href="<?= SITE_URL ?>mv-includes/scss/seat-style.css">
    <script src="<?= SITE_URL ?>mv-includes/js/sass.dart.js"></script>
</head>
<div class="d-flex flex-column" id="content-wrapper">
    <div class="highlight-blue">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Book Seats</h2>
                <p class="text-center">Select Your Seats</p>
            </div>
        </div>
    </div>
</div>
<div class="row row-margin">
    <div class="seat">
        <input type="checkbox" id="A1"><label for="A1">A1</label>
    </div>
</div>
<div class="row row-margin">
    <div class="seat">
        <input type="checkbox" id="A2"><label for="A2">A1</label>
    </div>
</div>

