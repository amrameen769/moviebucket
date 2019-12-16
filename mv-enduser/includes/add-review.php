<?php
require("../../config/autoload.php");

$stars = $_POST['stars'];
$review = mysqli_real_escape_string($dbconn, $_POST['review']);
$mv_id = mysqli_real_escape_string($dbconn, $_POST['mv_id']);

$errors = array();

$review_date = date('Y-m-d');

$mb = new MovieBook();
$movieDetails = $mb->selectMovie($mv_id);

if ($review_date < $movieDetails['mv_release_date']) {
    array_push($errors, "Movie not Yet Released, You can't Add Review");
}
if (count($errors) == 0) {
    if (empty($review)) {
        array_push($errors, "Review Can't Be Empty");
    }

}
$gd = new getData();

$user_id = $gd->returnUserID($_SESSION['username']);

$rating = 0;
switch ($stars) {
    case 1 :
        $rating = 1;
        break;
    case 2 :
        $rating = 2;
        break;
    case 3 :
        $rating = 3;
        break;
    case 4 :
        $rating = 4;
        break;
    case 5 :
        $rating = 5;
        break;
    default:
        $rating = 0;
}


if (count($errors) == 0) {
    $insertReview = $dbconn->query("insert into tbl_review (user_id,mv_id, mv_review, mv_rating, review_date) values($user_id, $mv_id,'$review',$rating, '$review_date')");
} else {
    require(SITE_PATH . "mv-content/errors.php");
}

$reviewDetails = $gd->selectReviews($mv_id);

if (empty($reviewDetails)) : ?>
    <div class="jumbotron text-center" id="not-found"><h1>No Reviews Found!</h1></div>
    <div class="textarea-height">
        <fieldset class="rating">
            <span class="heading">Your Rating</span>
            <input type="radio" id="star5" name="rating" value="5"/><label class="full"
                                                                           for="star5"
                                                                           title="Awesome - 5 stars"></label>
            <!--                                    <input type="radio" id="star4half" name="rating" value="4 and a half"/><label-->
            <!--                                            class="half"-->
            <!--                                            for="star4half"-->
            <!--                                            title="Pretty good - 4.5 stars"></label>-->
            <input type="radio" id="star4" name="rating" value="4"/><label class="full"
                                                                           for="star4"
                                                                           title="Pretty good - 4 stars"></label>
            <!--                                    <input type="radio" id="star3half" name="rating" value="3 and a half"/><label-->
            <!--                                            class="half"-->
            <!--                                            for="star3half"-->
            <!--                                            title="Meh - 3.5 stars"></label>-->
            <input type="radio" id="star3" name="rating" value="3"/><label class="full"
                                                                           for="star3"
                                                                           title="Meh - 3 stars"></label>
            <!--                                    <input type="radio" id="star2half" name="rating" value="2 and a half"/><label-->
            <!--                                            class="half"-->
            <!--                                            for="star2half"-->
            <!--                                            title="Kinda bad - 2.5 stars"></label>-->
            <input type="radio" id="star2" name="rating" value="2"/><label class="full"
                                                                           for="star2"
                                                                           title="Kinda bad - 2 stars"></label>
            <!--                                    <input type="radio" id="star1half" name="rating" value="1 and a half"/><label-->
            <!--                                            class="half"-->
            <!--                                            for="star1half"-->
            <!--                                            title="Meh - 1.5 stars"></label>-->
            <input type="radio" id="star1" name="rating" value="1"/><label class="full"
                                                                           for="star1"
                                                                           title="Sucks big time - 1 star"></label>
            <!--                                    <input type="radio" id="starhalf" name="rating" value="half"/><label-->
            <!--                                            class="half"-->
            <!--                                            for="starhalf"-->
            <!--                                            title="Sucks big time - 0.5 stars"></label>-->
        </fieldset>

        <div class="input-group textarea-height">
                    <textarea id="review" class="form-control"
                              aria-label="Add Your Review"></textarea>
        </div>
        <button id="add-review" onclick="updateReview()"
                class="btn btn-primary input-group-text">
            Add Your Review
        </button>
    </div>
<?php else : ?>
    <div class="row">
        <div class="col">
            <div class="col-lg-auto margin-post">
                <?php $i = 0;
                $rating = 0; ?>
                <?php foreach ($reviewDetails as $reviewDetail) : ?>
                    <h3><?= $reviewDetail['mv_name'] . " Review: #" . ++$i ?></h3>
                    <div class="info"><span
                                class="text-muted"><?= $reviewDetail['user_name'] . " on " . $reviewDetail['date'] ?></span>
                    </div>
                    <p><?= $reviewDetail['review'] ?></p>
                    <?php $rating += $reviewDetail['rating'] ?>
                <?php endforeach ?>
            </div>
        </div>
        <div class="col">
            <div class="rate-movie">
                <span class="heading">User Rating</span>
                <?php $avg_rating = floor($rating / count($reviewDetails));
                $j = 0;
                while ($j < $avg_rating) :?>
                    <span class='fa fa-star checked'></span>
                    <?php $j++; ?>
                <?php endwhile ?>
                <p><?php echo $rating / count($reviewDetails) . " out of " . $i . " Ratings" ?></p>
                <hr style="border:3px solid #f1f1f1">

            </div>
            <div class="textarea-height">
                <fieldset class="rating">
                    <span class="heading">Your Rating</span>
                    <input type="radio" id="star5" name="rating" value="5"/><label class="full"
                                                                                   for="star5"
                                                                                   title="Awesome - 5 stars"></label>
                    <!--                    <input type="radio" id="star4half" name="rating" value="4 and a half"/><label-->
                    <!--                            class="half"-->
                    <!--                            for="star4half"-->
                    <!--                            title="Pretty good - 4.5 stars"></label>-->
                    <input type="radio" id="star4" name="rating" value="4"/><label class="full"
                                                                                   for="star4"
                                                                                   title="Pretty good - 4 stars"></label>
                    <!--                    <input type="radio" id="star3half" name="rating" value="3 and a half"/><label-->
                    <!--                            class="half"-->
                    <!--                            for="star3half"-->
                    <!--                            title="Meh - 3.5 stars"></label>-->
                    <input type="radio" id="star3" name="rating" value="3"/><label class="full"
                                                                                   for="star3"
                                                                                   title="Meh - 3 stars"></label>
                    <!--                    <input type="radio" id="star2half" name="rating" value="2 and a half"/><label-->
                    <!--                            class="half"-->
                    <!--                            for="star2half"-->
                    <!--                            title="Kinda bad - 2.5 stars"></label>-->
                    <input type="radio" id="star2" name="rating" value="2"/><label class="full"
                                                                                   for="star2"
                                                                                   title="Kinda bad - 2 stars"></label>
                    <!--                    <input type="radio" id="star1half" name="rating" value="1 and a half"/><label-->
                    <!--                            class="half"-->
                    <!--                            for="star1half"-->
                    <!--                            title="Meh - 1.5 stars"></label>-->
                    <input type="radio" id="star1" name="rating" value="1"/><label class="full"
                                                                                   for="star1"
                                                                                   title="Sucks big time - 1 star"></label>
                    <!--                    <input type="radio" id="starhalf" name="rating" value="half"/><label-->
                    <!--                            class="half"-->
                    <!--                            for="starhalf"-->
                    <!--                            title="Sucks big time - 0.5 stars"></label>-->
                </fieldset>

                <div class="input-group textarea-height">
                    <textarea id="review" class="form-control"
                              aria-label="Add Your Review"></textarea>
                </div>
                <button id="add-review" onclick="updateReview()"
                        class="btn btn-primary input-group-text">
                    Add Your Review
                </button>
            </div>
        </div>
    </div>
<?php
endif ?>