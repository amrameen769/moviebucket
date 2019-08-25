<?php require("../config/autoload.php");
$sec = new Secure;
$sec -> checkTSign();



$thr_uname = $_SESSION['thr_name'];
$selQuery = "SELECT thr_id FROM tbl_theater WHERE thr_uname = '$thr_uname'";
$results = mysqli_query($dbconn,$selQuery);
if(mysqli_num_rows($results) > 0){
  $row = mysqli_fetch_assoc($results);
  $thr_id = $row['thr_id'];
}

$rem = new RemoveData;
$rem->removeMovie($thr_id);

?>
<?php
  $mv_name = "";
  $mv_hero = "";
  $mv_heroine = "";
  $mv_lang = "";
  $mv_director = "";
  $mv_producer = "";
  $mv_release_date = "";
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add Movie</title>
  </head>
  <?php require(SITE_PATH."mv-content/header.php"); ?>
<style>
label{
  padding-left: 20px;
}
</style>
  <body>
    <div class="container-fluid">
        <form class="col- col-sm col-md col-lg col-xl form-movie mx-auto d-block" action="" method="post">
          <br>
          <p class ="heading" >Update Movie</p>
          <br>
            <?php
            $errors = array();
            if(isset($_POST['request'])){

               $mv_name = mysqli_real_escape_string($dbconn,$_POST['mv_name']);
               $mv_hero = mysqli_real_escape_string($dbconn,$_POST['mv_hero']);
               $mv_heroine = mysqli_real_escape_string($dbconn,$_POST['mv_heroine']);
               $mv_lang = mysqli_real_escape_string($dbconn,$_POST['mv_lang']);
               $mv_director = mysqli_real_escape_string($dbconn,$_POST['mv_director']);
               $mv_producer = mysqli_real_escape_string($dbconn,$_POST['mv_producer']);
               $mv_release_date = mysqli_real_escape_string($dbconn,$_POST['mv_release_date']);

               if(empty($mv_name)){ array_push($errors, "Movie name Needed");}
               if(empty($mv_hero)){ array_push($errors, "Movie hero Needed");}
               if(empty($mv_heroine)){ array_push($errors, "Movie heroine Needed");}
               if(empty($mv_lang)){ array_push($errors, "Movie language Needed");}
               if(empty($mv_director)){ array_push($errors, "Movie director Needed");}
               if(empty($mv_producer)){ array_push($errors, "Movie producer Needed");}
               if(empty($mv_release_date)){ array_push($errors, "Release Date Needed");}


                $checkExistingQuery = "SELECT mv_name FROM tbl_movie WHERE mv_name = '$mv_name' AND mv_hero = '$mv_hero'
               AND mv_heroine = '$mv_heroine' AND mv_lang = '$mv_lang' AND mv_director = '$mv_director' AND mv_producer = '$mv_producer' AND mv_status= TRUE ";
               $results = mysqli_query($dbconn,$checkExistingQuery);
               if(mysqli_num_rows($results) > 0){
                 array_push($errors, "Movie Already Exists");
               }
               else if(count($errors) == 0){
                   $statusQuery = "SELECT mv_status FROM tbl_movie WHERE mv_name = '$mv_name' AND mv_hero = '$mv_hero'
                    AND mv_heroine = '$mv_heroine' AND mv_lang = '$mv_lang' AND mv_director = '$mv_director' AND mv_producer = '$mv_producer'";
                   $status = $exec ->query($statusQuery);
                   if(mysqli_num_rows($status) > 0){
                       if($mv_status = mysqli_fetch_assoc($status)){
                           //echo $mv_status['mv_status'];
                           if($mv_status['mv_status'] == 0){
                               $changeStatusQuery = "UPDATE tbl_movie SET mv_status = TRUE, thr_id='$thr_id' WHERE mv_name = '$mv_name' AND mv_hero = '$mv_hero'
                                AND mv_heroine = '$mv_heroine' AND mv_lang = '$mv_lang' AND mv_director = '$mv_director' AND mv_producer = '$mv_producer'";
                               $cStatus = $exec -> query($changeStatusQuery);
                               if($cStatus){
                                   $_SESSION['addmovie'] = "Movie Added";
                                   //header("location:add-movie.php");
                                   $mv_name = "";
                                   $mv_hero = "";
                                   $mv_heroine = "";
                                   $mv_lang = "";
                                   $mv_director = "";
                                   $mv_producer = "";
                               }
                               else{
                                   echo "Impossible";
                               }
                           }
                       }
                   }
                   else{
                       $insQuery = "INSERT INTO tbl_movie (mv_name, mv_hero, mv_heroine, mv_lang, mv_director, mv_producer, rq_status, thr_id, mv_status, mv_release_date)
                                VALUES('$mv_name', '$mv_hero', '$mv_heroine', '$mv_lang', '$mv_director', '$mv_producer',0,'$thr_id',TRUE,'$mv_release_date')";
                       if(!mysqli_query($dbconn,$insQuery)){
                           array_push($errors, "Internal Insertion Error");
                       }
                       else{
                           $_SESSION['addmovie'] = "Movie Added";
                           //header("location:add-movie.php");
                           $mv_name = "";
                           $mv_hero = "";
                           $mv_heroine = "";
                           $mv_lang = "";
                           $mv_director = "";
                           $mv_producer = "";
                           $mv_release_date = "";
                       }
                   }
               }
            }
             require("../mv-content/errors.php");
           ?>
            <?php if(isset($_SESSION['addmovie'])) : ?>
                <div id=error class="animated fadeInDown delay-02s"><p><?= $_SESSION['addmovie']?></p></div>
                <?php
                unset($_SESSION['addmovie']);
            endif ?>

            <?php if(isset($_SESSION['remove_mov'])) : ?>
                <div id=error class="animated fadeInDown delay-02s"><p><?= $_SESSION['remove_mov']?></p></div>
                <?php
                unset($_SESSION['remove_mov']);
            endif ?>
          <div class="add-info table-responsive">
              <table class="table">
                  <tr>
                      <td>
                          <label for="formGroupExampleInput">Movie Name</label>
                          <input class="form-control field-width" id="formGroupExampleInput" type="text" name="mv_name" value="<?= $mv_name ?>"><br><br>
                      </td>
                      <td>
                          <label for="formGroupExampleInput">Hero</label>
                          <input class="form-control field-width" id="formGroupExampleInput" type="text" name="mv_hero" value="<?= $mv_hero ?>"><br><br>
                      </td>
                      <td>
                          <label for="formGroupExampleInput">Heroine</label>
                          <input class="form-control field-width" id="formGroupExampleInput" type="text" name="mv_heroine" value="<?= $mv_heroine ?>"><br><br>
                      </td>
                      <td>
                          <label for="formGroupExampleInput">Language</label>
                          <input class="form-control field-width" id="formGroupExampleInput" type="text" name="mv_lang" value="<?= $mv_lang ?>"><br><br>
                      </td>
                      <td>
                          <label for="formGroupExampleInput">Director</label>
                          <input class="form-control field-width" id="formGroupExampleInput" type="text" name="mv_director" value="<?= $mv_director ?>"><br><br>
                      </td>
                      <td>
                          <label for="formGroupExampleInput">Producer</label>
                          <input class="form-control field-width" id="formGroupExampleInput" type="text" name="mv_producer" value="<?= $mv_producer ?>"><br><br>
                      </td>
                      <td>
                          <label for="formGroupExampleInput">Release Date</label>
                          <input class="form-control field-width" id="formGroupExampleInput" type="date" name="mv_release_date" value="<?= $mv_release_date ?>"><br><br>
                      </td>
                  </tr>
              </table>
            <button type="submit" name="request" class="btn btn-primary mx-auto d-block">Request</button>
          </div>
        </form>
    </div>
    <form method="post">
        <div class="table-responsive distance">
            <table class="table">
                <thead>
                <tr>
                    <th>Sl. No</th>
                    <th>Movie</th>
                    <th>Hero</th>
                    <th>Heroine</th>
                    <th>Language</th>
                    <th>Director</th>
                    <th>Producer</th>
                    <th>Release Date</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        $selQuery = "SELECT * FROM tbl_movie WHERE thr_id = '$thr_id' AND mv_status = TRUE";
                        $results = mysqli_query($dbconn,$selQuery);
                        if(mysqli_num_rows($results) > 0){
                            while($row = mysqli_fetch_assoc($results)): ?>
                    <tr>
                        <td><?=$i++?></td>
                        <td><?=$row['mv_name']?></td>
                        <td><?=$row['mv_hero']?></td>
                        <td><?=$row['mv_heroine']?></td>
                        <td><?=$row['mv_lang']?></td>
                        <td><?=$row['mv_director']?></td>
                        <td><?=$row['mv_producer']?></td>
                        <td><?=$row['mv_release_date']?></td>
                        <td>
                            <button class="btn btn-primary" type="submit" name="remove_mov" value="<?=$row['mv_id']?>">Remove Movie</button>
                        </td>
                    </tr>
                    <?php endwhile;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </form>
    <?php require(SITE_PATH."mv-content/footer.php");?>
</html>
