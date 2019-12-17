<?php
require("../config/autoload.php");

$sec = new Secure;
$sec->checkUSign();

require(SITE_PATH . "mv-content/header.php");

$disabled = "";
$user_id = $gd->returnUserID($_SESSION['username']);
?>
<head>
    <title>Book Movies</title>
    <link rel="stylesheet" href="includes/rating-style.css">
</head>
<body id="book-page">
<div class="row row-margin">
    <?php
    if (isset($_POST['btn-mov-book'])) {
    $mv_id = $_POST['btn-mov-book'];
    if ($gd->selectReviewer($user_id, $mv_id)) {
        $disabled = 'disabled';
    }
    $mb = new MovieBook;
    $movie = $mb->selectMovie($mv_id);
    if (!empty($movie)) : ?>
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-primary py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                <span>
                                    <img src="<?= SITE_URL ?>mv-theater/mv-thumb/<?= $movie['mv_thumb'] ?>"
                                         alt="mv-thumb.jpg">
                                </span>
                        </div>
                        <div>
                            <span>Movie Name: </span>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span><?= $movie['mv_name'] ?></span></div>
                            <span>Hero: </span>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span><?= $movie['mv_hero'] ?></span></div>
                            <span>Heroine: </span>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span><?= $movie['mv_heroine'] ?></span></div>
                            <span>Language: </span>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span><?= $movie['mv_lang'] ?></span></div>
                            <span>Director: </span>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span><?= $movie['mv_director'] ?></span></div>
                            <span>Producer: </span>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span><?= $movie['mv_producer'] ?></span></div>
                            <span>Release Date: </span>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span><?= $movie['mv_release_date'] ?></span></div>
                            <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                        </div>
                        <div>
                            <button id="mv-id" class="btn btn-primary" name="btn-show-book"
                                    value="<?= $mv_id ?>"
                                    onclick="loadShow(this.value)">Shows
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col" id="review-posts">
        <?php

        $gd = new getData();
        $reviewDetails = $gd->selectReviews($mv_id);

        if (empty($reviewDetails)) : ?>
            <div class="jumbotron text-center" id="not-found"><h1>No Reviews Found!</h1></div>
            <div class="textarea-height">
                <fieldset class="rating">
                    <span class="heading">Your Rating</span>
                    <input type="radio" id="star5" name="rating" value="5" <?= $disabled ?>/><label class="full"
                                                                                                    for="star5"
                                                                                                    title="Awesome - 5 stars"></label>
                    <!--                                    <input type="radio" id="star4half" name="rating" value="4 and a half"/><label-->
                    <!--                                            class="half"-->
                    <!--                                            for="star4half"-->
                    <!--                                            title="Pretty good - 4.5 stars"></label>-->
                    <input type="radio" id="star4" name="rating" value="4" <?= $disabled ?>/><label class="full"
                                                                                                    for="star4"
                                                                                                    title="Pretty good - 4 stars"></label>
                    <!--                                    <input  type="radio" id="star3half" name="rating" value="3 and a half"/><label-->
                    <!--                                            class="half"-->
                    <!--                                            for="star3half"-->
                    <!--                                            title=" Meh - 3.5 stars"></label>-->
                    <input type="radio" id="star3" name="rating" value="3" <?= $disabled ?>/><label class="full"
                                                                                                    for="star3"
                                                                                                    title="Meh - 3 stars"></label>
                    <!--                                    <input type="radio" id="star2half" name="rating" value="2 and a half"/><label-->
                    <!--                                            class="half"-->
                    <!--                                            for="star2half"-->
                    <!--                                            title="Kinda bad - 2.5 stars"></label>-->
                    <input type="radio" id="star2" name="rating" value="2" <?= $disabled ?>/><label class="full"
                                                                                                    for="star2"
                                                                                                    title="Kinda bad - 2 stars"></label>
                    <!--                                    <input type="radio" id="star1half" name="rating" value="1 and a half"/><label-->
                    <!--                                            class="half"-->
                    <!--                                            for="star1half"-->
                    <!--                                            title="Meh - 1.5 stars"></label>-->
                    <input type="radio" id="star1" name="rating" value="1" <?= $disabled ?>/><label class="full"
                                                                                                    for="star1"
                                                                                                    title="Sucks big time - 1 star"></label>
                    <!--                                    <input type="radio" id="starhalf" name="rating" value="half"/><label-->
                    <!--                                            class="half"-->
                    <!--                                            for="starhalf"-->
                    <!--                                            title="Sucks big time - 0.5 stars"></label>-->
                </fieldset>

                <div class="input-group textarea-height">
                    <textarea id="review" class="form-control"
                              aria-label="Add Your Review" <?= $disabled ?>></textarea>
                </div>
                <button id="add-review" onclick="updateReview()"
                        class="btn btn-primary input-group-text"
                    <?= $disabled ?>
                >
                    Add Your Review
                </button>
            </div>
        <?php else : ?>
            <div class="row">
                <div class="col">
                    <div class="col-lg-auto margin-post">
                        <?php $i = 0;
                        $rating = 0; ?>
                        <span class="heading">User Reviews</span>
                        <?php foreach ($reviewDetails as $reviewDetail) : ?>
                            <div class="review-margin">
                                <h3><?= $reviewDetail['mv_name'] . " Review: #" . ++$i ?></h3>
                                <div class="info"><span
                                            class="text-muted"><?= $reviewDetail['user_name'] . " on " . $reviewDetail['date'] ?></span>
                                </div>
                                <p><?= $reviewDetail['review'] ?></p>
                                <?php $rating += $reviewDetail['rating'] ?>
                                <?php for ($k = 0; $k < $reviewDetail['rating']; $k++) : ?>
                                    <span class='fa fa-star checked'></span>
                                <?php endfor ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="col">
                    <div class="rate-movie margin-post">
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
                            <input type="radio" id="star5" name="rating" value="5" <?= $disabled ?>/><label class="full"
                                                                                                            for="star5"
                                                                                                            title="Awesome - 5 stars"></label>
                            <!--                                    <input type="radio" id="star4half" name="rating" value="4 and a half"/><label-->
                            <!--                                            class="half"-->
                            <!--                                            for="star4half"-->
                            <!--                                            title="Pretty good - 4.5 stars"></label>-->
                            <input type="radio" id="star4" name="rating" value="4" <?= $disabled ?>/><label class="full"
                                                                                                            for="star4"
                                                                                                            title="Pretty good - 4 stars"></label>
                            <!--                                    <input type="radio" id="star3half" name="rating" value="3 and a half"/><label-->
                            <!--                                            class="half"-->
                            <!--                                            for="star3half"-->
                            <!--                                            title="Meh - 3.5 stars"></label>-->
                            <input type="radio" id="star3" name="rating" value="3" <?= $disabled ?>/><label class="full"
                                                                                                            for="star3"
                                                                                                            title="Meh - 3 stars"></label>
                            <!--                                    <input type="radio" id="star2half" name="rating" value="2 and a half"/><label-->
                            <!--                                            class="half"-->
                            <!--                                            for="star2half"-->
                            <!--                                            title="Kinda bad - 2.5 stars"></label>-->
                            <input type="radio" id="star2" name="rating" value="2" <?= $disabled ?>/><label class="full"
                                                                                                            for="star2"
                                                                                                            title="Kinda bad - 2 stars"></label>
                            <!--                                    <input type="radio" id="star1half" name="rating" value="1 and a half"/><label-->
                            <!--                                            class="half"-->
                            <!--                                            for="star1half"-->
                            <!--                                            title="Meh - 1.5 stars"></label>-->
                            <input type="radio" id="star1" name="rating" value="1" <?= $disabled ?>/><label class="full"
                                                                                                            for="star1"
                                                                                                            title="Sucks big time - 1 star"></label>
                            <!--                                    <input type="radio" id="starhalf" name="rating" value="half"/><label-->
                            <!--                                            class="half"-->
                            <!--                                            for="starhalf"-->
                            <!--                                            title="Sucks big time - 0.5 stars"></label>-->
                        </fieldset>

                        <div class="input-group textarea-height">
                    <textarea id="review" class="form-control"
                              aria-label="Add Your Review" <?= $disabled ?>></textarea>
                        </div>
                        <button id="add-review" onclick="updateReview()"
                                class="btn btn-primary input-group-text"
                            <?= $disabled ?>
                        >
                            Add Your Review
                        </button>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
<?php
endif;
}
?>
</div>
</body>
<script>
    function updateReview() {
        let mv_id = document.getElementById("mv-id").value;
        let selected_stars = '';
        let stars = document.getElementsByName("rating");
        let review = document.getElementById("review").value;

        for (let i = 0; i < stars.length; i++) {
            if (stars[i].type === 'radio' && stars[i].checked === true) {
                selected_stars = stars[i].value;
            }
        }
        $.ajax({
            type: "POST",
            url: "https://moviebucket.com/mv-enduser/includes/add-review.php",
            data: {
                'stars': selected_stars,
                'review': review,
                'mv_id': mv_id
            },
            cache: false,

            success: function (response) {
                $("#review-posts").html(response);
            }
        });
    }
</script>

<?php require(SITE_PATH . "mv-content/footer.php"); ?>

