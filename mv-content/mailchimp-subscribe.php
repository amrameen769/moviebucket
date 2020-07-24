<?php

$email = $user_mail;
$list_id = '0193d026ee';
$api_key = '84213a24bce4f5bf3a44fa249b4bb860-us20';

$data_center = substr($api_key, strpos($api_key, '-') + 1);

$url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members';

$json = json_encode([
    'email_address' => $email,
    'status' => 'subscribed', //pass 'subscribed' or 'pending'
    'merge_fields' => ['FNAME' => $user_name],
]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
$result = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$_SESSION['subscription'] = "Signed Up Successfully, Now Login!";
?>