<?php require('../../config/autoload.php');

$sec = new Secure;
$sec->checkADSign();

require('ad-header.php');

use Mpdf\Mpdf;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reports</title>

</head>
<body>

<div class="d-flex flex-column" id="content-wrapper">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <button class="btn btn-primary btn-sm d-none d-sm-inline-block" id="ar-button" value="annual">
                            <i class="fas fa-download fa-sm text-white-50"></i>
                            Annual Income
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-primary btn-sm d-none d-sm-inline-block" id="sr-button" value="show">
                            <i class="fas fa-download fa-sm text-white-50"></i>
                            Shows Report
                        </button>
                    </li>
                </ul>
            </div>
            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                <p class="container" id="report-body"></p>
            </div>
        </div>
    </div>
    <footer class="bg-white sticky-footer">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Brand 2019</span></div>
        </div>
    </footer>
</div>

</div>
</body>

<script>
    document.getElementById('ar-button').addEventListener('click', generateAnnualReport);
    document.getElementById('sr-button').addEventListener('click', generateShowReport);

    function generateAnnualReport() {
        var reportid = document.getElementById('ar-button').value;
        var report = "reportid=" + reportid;
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '<?=SITE_URL?>mv-admin/includes/generate.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhttp.onload = function () {
            document.getElementById('report-body').innerHTML = this.responseText;
        }

        xhttp.send(report);
    }

    function generateShowReport() {
        var reportid = document.getElementById('sr-button').value;
        var report = "reportid=" + reportid;
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '<?=SITE_URL?>mv-admin/includes/generate.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhttp.onload = function () {
            document.getElementById('report-body').innerHTML = this.responseText;
        }

        xhttp.send(report);
    }
    /*function test(){
        alert(document.getElementById('trsd').value);
    }*/
</script>
</html>

