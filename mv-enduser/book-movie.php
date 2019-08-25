<?php
require("../config/autoload.php");

$sec = new Secure;
$sec->checkUSign();

require (SITE_PATH."mv-content/header.php");
?>
<div class="col-md-6 col-xl-3 mb-4">

<?php
$mb = new MovieBook;
$movies = $mb->selectMovies();
if(is_array($movies)){
    foreach($movies as $movie){
        if(is_array($movie)) : ?>
                <div class="card shadow border-left-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                            <span>
                                                <img src="<?=SITE_URL?>mv-includes/images/saaho.jpg" alt="saaho.jpg">
                                            </span>
                                </div>
                                <div class="text-dark font-weight-bold h5 mb-0"><span><?=$movie['mv_name']?></span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
        <?php endif;
    }
}
?>
</div>

<?php require(SITE_PATH."mv-content/footer.php");?>
