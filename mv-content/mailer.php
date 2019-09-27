<?php
//echo phpinfo();

use \DrewM\MailChimp\MailChimp;

$bookmail = new MailChimp('82420be4cb97df024570e850ba3c99a6-us20');

$listResults = $bookmail->get('lists');

$list_id = null;
if (isset($listResults)) {
    foreach ($listResults['lists'] as $listResult) {
        if ($listResult['name'] == "moviebucket") {
            $list_id = $listResult['id'];
        }
    }
}


$subscriber_hash = MailChimp::subscriberHash($user_mail);
$subscription = $bookmail->get("lists/{$list_id}/members/{$subscriber_hash}");


/*if(isset($subscription['status']) && $subscription['status'] === 'subscribed'){
    $updatelog = $bookmail->patch("lists/{$list_id}/members/{$subscriber_hash}", [
        'merge_fields' => ['FNAME'=>$user_name],
    ]);
} */

if (!isset($subscription['status']) || $subscription['status'] !== 'subscribed') {
    $updatelog = $bookmail->post("lists/{$list_id}/members",
        ['email_address' => $user_mail,
            'status' => 'subscribed',
            'merge_fields' => ['FNAME' => $username]
        ]
    );
}

/* if($bookmail->success()){
    echo "Welcome Message Sent<br>";
} else {
    echo $bookmail->getLastError();
} */
?>