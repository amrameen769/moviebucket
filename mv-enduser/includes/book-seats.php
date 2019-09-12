<?php
$selected_seats = json_decode(stripcslashes($_POST['data']));

foreach ($selected_seats as $selected_seat) {
    echo $selected_seat."<br>";
}