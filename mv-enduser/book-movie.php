<?php
require("../config/autoload.php");

$sec = new Secure;
$sec->checkUSign();

require (SITE_PATH."mv-content/header.php");
?>
<div class="row">
    <?php
    if(isset($_REQUEST['t'])){
        $mv_id = $_REQUEST['t'];
        $mb = new MovieBook;
        $movie = $mb->selectMovie($mv_id);
        if(!empty($movie)) : ?>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                <span>
                                    <img src="<?=SITE_URL?>mv-includes/images/saaho.jpg" alt="saaho.jpg">
                                </span>
                            </div>
                            <div>
                                <span>Movie Name: </span><div class="text-dark font-weight-bold h5 mb-0"><span><?=$movie['mv_name']?></span></div>
                                <span>Hero: </span><div class="text-dark font-weight-bold h5 mb-0"><span><?=$movie['mv_hero']?></span></div>
                                <span>Heroine: </span><div class="text-dark font-weight-bold h5 mb-0"><span><?=$movie['mv_heroine']?></span></div>
                                <span>Language: </span><div class="text-dark font-weight-bold h5 mb-0"><span><?=$movie['mv_lang']?></span></div>
                                <span>Director: </span><div class="text-dark font-weight-bold h5 mb-0"><span><?=$movie['mv_director']?></span></div>
                                <span>Producer: </span><div class="text-dark font-weight-bold h5 mb-0"><span><?=$movie['mv_producer']?></span></div>
                                <span>Release Date: </span><div class="text-dark font-weight-bold h5 mb-0"><span><?=$movie['mv_release_date']?></span></div>
                                <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif;
    }
    ?>
</div>
<?php require(SITE_PATH."mv-content/footer.php");?>
