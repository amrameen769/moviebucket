<?php require ("../../config/autoload.php");
if (isset($_POST['cancels'])) : ?>
    <?php
    $errors = array();
    $cancels = json_decode(stripcslashes($_POST['cancels']));
    if (count($cancels) > 0) : ?>
        <div class="jumbotron text-center animated fadeInDown delay-02s">
            <button class="btn btn-danger" id="cancelsure" onclick="cancelSure()">Are your sure?</button>
        </div>
    <?php else : ?>
        <?php array_push($errors, "No bookings Selected");
        require (SITE_PATH."mv-content/errors.php");
        ?>
    <?php endif ?>
<?php endif ?>

