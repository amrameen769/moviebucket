<?php
require("../../config/autoload.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Receipt</title>
</head>
<?php
$selected_seats = json_decode(stripcslashes($_POST['seats']));
$shw_id = json_decode(stripcslashes($_POST['shw_id']));
$username = $_SESSION['username'];

$gd = new getData;


$user_mail = $gd->returnUserMail($username);
?>

<body>
<div class="d-flex flex-column" id="content-wrapper">
    <div class="highlight-blue">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Payment Details</h2>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card shadow border-left-info py-2">
        <div class="container">
            <h3>Selected Seats</h3>
            <?php foreach ($selected_seats as $selected_seat) : ?>
                <div>
                    <?= "Seat ID: " . $selected_seat ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="container">
            <?php
            echo date("d-m-Y H:i:s");
            $mv_id = "";
            $shw_time = "";
            $thr_id = "";
            $thr_screen_id = "";
            $shw_date = "";
            $shw_cost = "";
            $shw_status = "";
            $selectShowDetails = "SELECT * FROM tbl_showtime WHERE shw_id='$shw_id' LIMIT 1";
            $resShows = $exec->query($selectShowDetails);
            if (mysqli_num_rows($resShows) > 0) {
                while ($row = mysqli_fetch_assoc($resShows)) {
                    $mv_id = $row['mv_id'];
                    $shw_time = $row['shw_time'];
                    $thr_id = $row['thr_id'];
                    $thr_screen_id = $row['thr_screen_id'];
                    $shw_date = $row['shw_date'];
                    $shw_cost = $row['shw_cost'];
                    $shw_status = $row['shw_status'];
                }
            }

            $errors = array();
            $pay_cost = $shw_cost * count($selected_seats);

            if ($shw_status == 0) {
                array_push($errors, "Show Doesn't Exist");
            }
            $gd = new getData;
            $mb = new MovieBook;
            $screen = new Screens;
            $seatAccess = new Seats;
            $bookShow = new Booking;
            $seatsBooked = $screen->checkSeatIfBooked($shw_id);
            if (is_array($seatsBooked)) {
                if (array_intersect($selected_seats, $seatsBooked) != null) {
                    array_push($errors, "Seats You Selected are Unavailable");
                }
            } else {
                array_push($errors, "Error Selecting Seats");
            }

            ?>
            <?php
            $movieDetails = $mb->selectMovie($mv_id);
            $thr_name = $gd->getTheater($thr_id);
            $thr_screen_name = $screen->returnScreenName($thr_screen_id);
            if (is_array($movieDetails)) : ?>
                <h3>Booking Details</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Movie Name</th>
                            <th>Hero</th>
                            <th>Heroine</th>
                            <th>Language</th>
                            <th>Director</th>
                            <th>Producer</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <?= $movieDetails['mv_name'] ?>
                                <div class="avatar-upload">
                                    <img class="avatar-preview"
                                         src="<?= SITE_URL ?>/mv-theater/mv-thumb/<?= $movieDetails['mv_thumb'] ?>"
                                         alt="movie_thumb">
                                </div>
                            </td>
                            <td><?= $movieDetails['mv_hero'] ?></td>
                            <td><?= $movieDetails['mv_heroine'] ?></td>
                            <td><?= $movieDetails['mv_lang'] ?></td>
                            <td><?= $movieDetails['mv_director'] ?></td>
                            <td><?= $movieDetails['mv_producer'] ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <h3>Show Details</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Theater</th>
                            <th>Screen ID</th>
                            <th>Show Date</th>
                            <th>Show Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?= $thr_name ?></td>
                            <td><?= $thr_screen_id ?></td>
                            <td><?= $shw_date ?></td>
                            <td><?= $shw_time ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <?php
            if (count($errors) == 0) {
                $user_id = $gd->returnUserID($username);
                foreach ($selected_seats as $selected_seat) {
                    $bookDetails = array('user_id' => $user_id, 'shw_id' => $shw_id, 'mv_id' => $mv_id, 'thr_id' => $thr_id, 'thr_screen_id' => $thr_screen_id, 'screen_seat_id' => $selected_seat, 'book_date' => date("Y-m-d H:i:s"), 'book_pay' => $pay_cost);
                    if ($bookShow->book($bookDetails)) {
                        array_push($errors, "Show Booked");
                    } else {
                        array_push($errors, "Booking Failed");
                    }
                }
            }

            require(SITE_PATH . "mv-content/errors.php");
            ?>
        </div>
    </div>
</div>
</body>
</html>

<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
require '../../config/vendor/autoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
//$mail->SMTPDebug = 2;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "andrewssan666@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "!ronmanlove777";
//Set who the message is to be sent from
try {
    $mail->setFrom('andrewssan666@gmail.com', 'MovieBucket.com');
} catch (\PHPMailer\PHPMailer\Exception $e) {
    echo $e->getMessage();
}
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress("amrameen769@gmail.com", $username);
//Set the subject line
$mail->Subject = 'MovieBucket.com Tickets have been Booked';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('book-seats.php'));
$mail->isHTML(true);
$mail->Body = "
    Payment Confirmed, Shows Booked.
";
//Replace the plain text body with one created manually
$mail->AltBody = 'Payment Confirmed, Shows Booked';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
try {
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
        //Section 2: IMAP
        //Uncomment these to save your message in the 'Sent Mail' folder.
        /*if (save_mail($mail)) {
            echo "Message saved!";
        }*/
    }
} catch (\PHPMailer\PHPMailer\Exception $e) {
    echo $e->getMessage();
}
//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
/*function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}*/
?>