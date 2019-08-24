<?php require("config/autoload.php");?>
<?php

if(isset($_SESSION)){
    session_destroy();
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to Movie Bucket</title>
      <link rel="stylesheet" href="mv-includes/fonts/webfontkit/stylesheet.css">
    <script type="text/javascript" src="<?=SITE_URL?>mv-includes/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="<?=SITE_URL?>mv-includes/css/bootstrap.css">
    <link rel="stylesheet" href="<?=SITE_URL?>mv-includes/css/master.css">
    <link rel="stylesheet" href="<?=SITE_URL?>mv-includes/css/animate.css">
    <link rel="stylesheet" href="<?=SITE_URL?>mv-includes/css/style.css">
    <link rel="stylesheet" href="<?=SITE_URL?>mv-includes/css/responsive.css">
      <link href="<?=SITE_URL?>mv-includes/images/mvbucket.ico" rel="icon" type="image/ico">
  </head>
  <body>
    <div class="">
    <section id="homeContainer">
      <div class="maze animated fadeInDown delay-02s">
        <div class="container">
  			<figure class="logo animated fadeInDown delay-02s">
  				<a href="#"><img src="<?=SITE_URL?>mv-includes/images/mvbucket.png" alt="moviebucket.com"></a>
  			</figure>
  			<h1 class="animated fadeInDown delay-03s">Welcome To Movie Bucket</h1>
  			<ul class="we-create animated fadeInUp delay-03s">
  				<li>Books Tickets, Read Movie Reviews</li>
  			</ul>
  			<a class="link animated fadeInUp delay-04s servicelink" href="<?=SITE_URL?>mv-content/login.php">Login</a>
            <a class="link animated fadeInUp delay-04s servicelink" href="<?=SITE_URL?>mv-content/registration.php">SignUp</a>
  		</div>
    </div>
    </section>
  </div>
  </body>
</html>