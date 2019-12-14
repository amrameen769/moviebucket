<?php require("../config/autoload.php");
$sec = new Secure;
$sec->checkTSign();


$thr_uname = $_SESSION['thr_uname'];
$selQuery = "SELECT thr_id FROM tbl_theater WHERE thr_uname = '$thr_uname'";
$results = mysqli_query($dbconn, $selQuery);
if (mysqli_num_rows($results) > 0) {
    $row = mysqli_fetch_assoc($results);
    $thr_id = $row['thr_id'];
}

$rem = new RemoveData;
$rem->removeMovie($thr_id);

$mov = new MovieBook();
$mov->editMovie($thr_id);

function findLang($languages, $lang_id)
{
    foreach ($languages as $code => $language) {
        if ($code == $lang_id) {
            return $language;
        }
    }
}

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
<?php require(SITE_PATH . "mv-content/header.php"); ?>
<style>
    label {
        padding-left: 20px;
    }
</style>
<body>
<div class="container-fluid">
    <?php
    $languages = array(
        "default" => "",
        "ar" => "Arabic",
        "zh" => "Chinese",
        "en" => "English",
        "fr" => "French",
        "de" => "German",
        "hi" => "Hindi",
        "ja" => "Japanese",
        "kn" => "Kannada",
        "ko" => "Korean",
        "ml" => "Malayalam",
        "ta" => "Tamil",
        "te" => "Telugu"
    );
    $errors = array();
    if (isset($_POST['request'])) {

        $mv_name = mysqli_real_escape_string($dbconn, $_POST['mv_name']);
        $mv_hero = mysqli_real_escape_string($dbconn, $_POST['mv_hero']);
        $mv_heroine = mysqli_real_escape_string($dbconn, $_POST['mv_heroine']);
        $lang_id = $_POST['mv_lang'];
        $mv_lang = mysqli_real_escape_string($dbconn, findLang($languages, $lang_id));
        $mv_director = mysqli_real_escape_string($dbconn, $_POST['mv_director']);
        $mv_producer = mysqli_real_escape_string($dbconn, $_POST['mv_producer']);
        $mv_release_date = mysqli_real_escape_string($dbconn, $_POST['mv_release_date']);

        if (empty($mv_name)) {
            array_push($errors, "Movie name Needed");
        }
        if (empty($mv_hero)) {
            array_push($errors, "Movie hero Needed");
        }
        if (empty($mv_heroine)) {
            array_push($errors, "Movie heroine Needed");
        }
        if (empty($mv_lang)) {
            array_push($errors, "Movie language Needed");
        }
        if (empty($mv_director)) {
            array_push($errors, "Movie director Needed");
        }
        if (empty($mv_producer)) {
            array_push($errors, "Movie producer Needed");
        }
        if (empty($mv_release_date)) {
            array_push($errors, "Release Date Needed");
        }

        $checkExistingQuery = "SELECT mv_name FROM tbl_movie WHERE mv_name = '$mv_name' AND mv_hero = '$mv_hero'
               AND mv_heroine = '$mv_heroine' AND mv_lang = '$mv_lang' AND mv_director = '$mv_director' AND mv_producer = '$mv_producer' AND mv_status= TRUE ";
        $results = mysqli_query($dbconn, $checkExistingQuery);
        if (mysqli_num_rows($results) > 0) {
            array_push($errors, "Movie Already Exists");
        } else if (count($errors) == 0) {
            $statusQuery = "SELECT mv_status FROM tbl_movie WHERE mv_name = '$mv_name' AND mv_hero = '$mv_hero'
                    AND mv_heroine = '$mv_heroine' AND mv_lang = '$mv_lang' AND mv_director = '$mv_director' AND mv_producer = '$mv_producer'";
            $status = $exec->query($statusQuery);
            if (mysqli_num_rows($status) > 0) {
                if ($mv_status = mysqli_fetch_assoc($status)) {
                    //echo $mv_status['mv_status'];
                    if ($mv_status['mv_status'] == 0) {
                        $changeStatusQuery = "UPDATE tbl_movie SET mv_status = TRUE, thr_id='$thr_id' WHERE mv_name = '$mv_name' AND mv_hero = '$mv_hero'
                                AND mv_heroine = '$mv_heroine' AND mv_lang = '$mv_lang' AND mv_director = '$mv_director' AND mv_producer = '$mv_producer'";
                        $cStatus = $exec->query($changeStatusQuery);
                        if ($cStatus) {
                            $_SESSION['addmovie'] = "Movie Added";
                            //header("location:add-movie.php");
                            $mv_name = "";
                            $mv_hero = "";
                            $mv_heroine = "";
                            $mv_lang = "";
                            $mv_director = "";
                            $mv_producer = "";
                        } else {
                            echo "Impossible";
                        }
                    }
                }
            } else {

                if (isset($_FILES['mv_thumb']) && $_FILES['mv_thumb']['error'] == 0) {
                    //array_push($errors,"Uploaded");
                    $imageProp = $_FILES['mv_thumb'];
                    $tmpName = $imageProp['name'];
                    $imgType = $imageProp['type'];
                    $imgSize = $imageProp['size'];

                    $extension = pathinfo($tmpName, PATHINFO_EXTENSION);
                    $validExts = array("jpeg" => "image/jpeg", "jpg" => "image/jpg", "png" => "image/png");
                    if (!array_key_exists($extension, $validExts)) {
                        array_push($errors, "Invalid File Uploaded");
                    }

                    $maxSize = 2 * 1024 * 1024;
                    if ($imgSize > $maxSize) {
                        array_push($errors, "File Size Exceeded");
                    }

                    if (in_array($imgType, $validExts)) {
                        $imgEncName = md5($imageProp['name']) . "." . $extension;
                        if (file_exists(SITE_PATH . "mv-theater/mv-thumb/" . $imgEncName)) {
                            array_push($errors, "Image Already Exists");
                        }
                    }
                } else {
                    array_push($errors, $_FILES['mv_thumb']['error'] . " - Upload Error");
                }


                if (count($errors) == 0) {
                    if (!move_uploaded_file($imageProp['tmp_name'], SITE_PATH . "mv-theater/mv-thumb/" . $imgEncName)) {
                        array_push($errors, "Upload Error");
                    }
                    if (count($errors) == 0) {
                        $insQuery = "INSERT INTO tbl_movie (mv_name, mv_hero, mv_heroine, mv_lang, mv_director, mv_producer, mv_release_date, mv_thumb, thr_id, rq_status,  mv_status)
                                    VALUES('$mv_name', '$mv_hero', '$mv_heroine', '$mv_lang', '$mv_director', '$mv_producer','$mv_release_date','$imgEncName','$thr_id',0,TRUE)";
                        if (!mysqli_query($dbconn, $insQuery)) {
                            array_push($errors, "Internal Insertion Error");
                        } else {
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
        }
    }
    require("../mv-content/errors.php");
    ?>
    <?php if (isset($_SESSION['addmovie'])) : ?>
        <div id=error class="animated fadeInDown delay-02s"><p><?= $_SESSION['addmovie'] ?></p></div>
        <?php
        unset($_SESSION['addmovie']);
    endif ?>

    <?php if (isset($_SESSION['remove_mov'])) : ?>
        <div id=error class="animated fadeInDown delay-02s"><p><?= $_SESSION['remove_mov'] ?></p></div>
        <?php
        unset($_SESSION['remove_mov']);
    endif ?>
    <div class="card shadow mb-3">
        <div class="card-header py-3">
            <p class="heading text-primary m-0 font-weight-bold">Update Movies</p>
        </div>
        <div class="card-body">
            <form method="post" action="add-movie.php" enctype="multipart/form-data">
                <div class="image-container">
                    <h1>Upload Image
                        <small>.png, .jpg, .jpeg Accepted</small>
                    </h1>
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' name="mv_thumb" id="mv_Upload" accept=".png, .jpg, .jpeg"/>
                            <label for="mv_Upload"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="mv_Preview"
                                 style="background-image: url(https://moviebucket.com/mv-includes/images/image-placeholder-circle.png);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group"><label for="mv_name"><strong>Movie</strong></label>
                            <input type="text"
                                   class="form-control"
                                   value="<?= $mv_name ?>"
                                   name="mv_name"/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group"><label for="mv_hero"><strong>Hero</strong><br/></label>
                            <input
                                    type="text"
                                    class="form-control"
                                    value="<?= $mv_hero ?>"
                                    name="mv_hero"/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group"><label for="mv_herone"><strong>Heroine</strong><br/></label><input
                                    type="text" class="form-control" value="<?= $mv_heroine ?>"
                                    name="mv_heroine"/>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group"><label for="first_name"><strong>Language</strong><br/></label>
                            <select class="form-control field-width" id="formGroupExampleInput" type="text"
                                    name="mv_lang">
                                <optgroup label="Select Language">
                                    <?php foreach ($languages as $code => $lang) : ?>
                                        <option value="<?= $code ?>"><?= $lang ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group"><label for="mv_director"><strong>Director</strong><br/></label><input
                                    type="text" class="form-control" value="<?= $mv_director ?>" name="mv_director"/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group"><label for="mv_producer"><strong>Producer</strong></label><input
                                    type="text" class="form-control" value="<?= $mv_producer ?>" name="mv_producer"/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group"><label for="mv_release_date"><strong>Release
                                    Date</strong><br/></label><input
                                    type="date" class="form-control" value="<?= $mv_release_date ?>"
                                    name="mv_release_date"/></div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="request" class="btn btn-primary mx-auto d-block">Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
<form method="post">
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive table mt-auto distance" role="grid">
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
                    $results = mysqli_query($dbconn, $selQuery);
                    if (mysqli_num_rows($results) > 0) {
                        while ($row = mysqli_fetch_assoc($results)): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td>
                                    <?= $row['mv_name'] ?>
                                    <div class="avatar-upload">
                                        <img class="avatar-preview"
                                             src="<?= SITE_URL ?>/mv-theater/mv-thumb/<?= $row['mv_thumb'] ?>"
                                             alt="movie_thumb">
                                    </div>
                                </td>
                                <td><?= $row['mv_hero'] ?></td>
                                <td><?= $row['mv_heroine'] ?></td>
                                <td><?= $row['mv_lang'] ?></td>
                                <td><?= $row['mv_director'] ?></td>
                                <td><?= $row['mv_producer'] ?></td>
                                <td><?= $row['mv_release_date'] ?></td>
                                <td>
                                    <button class="btn btn-primary" type="submit" name="remove_mov"
                                            value="<?= $row['mv_id'] ?>">Remove Movie
                                    </button>
                                    <button class="btn btn-primary" type="submit" name="edit_mov"
                                            value="<?= $row['mv_id'] ?>">Edit Movie
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#mv_Preview').css('background-image', 'url(' + e.target.result + ')');
                $('#mv_Preview').hide();
                $('#mv_Preview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#mv_Upload").change(function () {
        var imgprop = document.getElementById('mv_Upload').files[0];
        var mv_image_name = imgprop.name;
        var ext = mv_image_name.split('.').pop().toLowerCase();

        if ($.inArray(ext, ['jpeg', 'png', 'jpg']) === -1) {
            alert("Invalid File");
        } else {
            var imgsize = imgprop.size;
            if (imgsize > 2000000) {
                alert("Image size exceeded");
            } else {
                readURL(this);
            }
        }
    });
</script>
<?php require(SITE_PATH . "mv-content/footer.php"); ?>
</html>
