<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Edit Movie</title>
</head>
<?php
require("../config/autoload.php");
$sec = new Secure();
$sec->checkTSign();

require(SITE_PATH . "mv-content/header.php");

$thr_uname = $_SESSION['thr_uname'];

$mov = new MovieBook();
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

function findLang($languages, $lang_id)
{
    foreach ($languages as $id => $language) {
        if ($lang_id == $id) {
            return $language;
        }
    }
}

?>


<?php if (isset($_SESSION['mv_id'])) : ?>
    <?php
    $mv_id = $_SESSION['mv_id'];
    unset($_SESSION['mv_id']);
    $movieDet = $mov->selectMovie($mv_id);
    ?>

    <div class="card shadow mb-3">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Edit Movies - Do not refresh</p>
        </div>
        <div class="card-body">
            <form method="post" action="edit-movie.php" enctype="multipart/form-data">
                <div class="image-container">
                    <h1>Upload Image
                        <small>.png, .jpg, .jpeg Accepted</small>
                    </h1>
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' name="mv_thumb" id="mv_Upload" accept=".png, .jpg, .jpeg"
                                   value="<?= $movieDet['mv_thumb'] ?>"/>
                            <label for="mv_Upload"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="mv_Preview"
                                 style="background-image: url(https://moviebucket.com/mv-theater/mv-thumb/<?= $movieDet['mv_thumb'] ?>);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group"><label for="mv_name"><strong>Movie</strong></label>
                            <input type="text"
                                   class="form-control"
                                   value="<?= $movieDet['mv_name'] ?>"
                                   name="mv_name"/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group"><label for="mv_hero"><strong>Hero</strong><br/></label>
                            <input
                                    type="text"
                                    class="form-control"
                                    value="<?= $movieDet['mv_hero'] ?>"
                                    name="mv_hero"/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group"><label for="mv_herone"><strong>Heroine</strong><br/></label><input
                                    type="text" class="form-control" value="<?= $movieDet['mv_heroine'] ?>"
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
                                        <?php if ($lang == $movieDet['mv_lang']) : ?>
                                            <option value="<?= $code ?>" selected><?= $lang ?></option>
                                        <?php else: ?>
                                            <option value="<?= $code ?>"><?= $lang ?></option>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group"><label for="mv_director"><strong>Director</strong><br/></label><input
                                    type="text" class="form-control" value="<?= $movieDet['mv_director'] ?>"
                                    name="mv_director"/></div>
                    </div>
                    <div class="col">
                        <div class="form-group"><label for="mv_producer"><strong>Producer</strong></label><input
                                    type="text" class="form-control" value="<?= $movieDet['mv_producer'] ?>"
                                    name="mv_producer"/></div>
                    </div>
                    <div class="col">
                        <div class="form-group"><label for="mv_release_date"><strong>Release
                                    Date</strong><br/></label><input
                                    type="date" class="form-control" value="<?= $movieDet['mv_release_date'] ?>"
                                    name="mv_release_date"/></div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm" type="submit" name="mv_id" value="<?= $mv_id ?>">Save Movie
                    </button>
                </div>
            </form>
        </div>
    </div>
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
<?php endif ?>


<?php

if (isset($_POST['mv_id'])) {
    $mv_id = $_POST['mv_id'];
    $errors = array();

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

    $movieDet = $mov->selectMovie($mv_id);

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
                $imgDelete = $movieDet['mv_thumb'];
                unlink(SITE_PATH . "mv-theater/mv-thumb/" . $imgDelete);
                //array_push($errors, "Image Already Exists");
            }
        }

        if (count($errors) == 0) {
            if (!move_uploaded_file($imageProp['tmp_name'], SITE_PATH . "mv-theater/mv-thumb/" . $imgEncName)) {
                array_push($errors, "Upload Error");
            }
        } else {
//        array_push($errors, $_FILES['mv_thumb']['error'] . " - Upload Error");
        }
    } else {
        $imgEncName = $movieDet['mv_thumb'];
    }
    if (count($errors) == 0) {
        $updateMovieQuery = $dbconn->query("UPDATE tbl_movie SET mv_name = '$mv_name', mv_hero = '$mv_hero', 
                     mv_heroine = '$mv_heroine', mv_lang = '$mv_lang', mv_director = '$mv_director', mv_producer = '$mv_producer',mv_release_date = '$mv_release_date', mv_thumb = '$imgEncName',
                     rq_status = FALSE where mv_id = $mv_id")
        or die("Error Updating Movie");
        if ($dbconn->affected_rows == 0) {
            array_push($errors, "No Changes Made");
        } else {
            array_push($errors, "Update Successful");
        }
    }
}
?>
<button type="button" class="btn btn-primary" onclick="window.history.go(-2)">Return</button>
<?php
require(SITE_PATH . "mv-content/errors.php");
require(SITE_PATH . "mv-content/footer.php"); ?>
