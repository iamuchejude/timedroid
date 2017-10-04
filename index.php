<?php
/**
 * Facebook messager time bot
 * Author: JudeTheGenius
 * 2nd October, 2017.
 */
$access_token = ""; // Facebook Access Token
$verify_token = ""; // Verification Token
$hub_verify_token = null;

if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}


if ($hub_verify_token === $verify_token) {
    echo $challenge;
}

$input = json_decode(file_get_contents('php://input'), true);

$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];

$message_to_reply = '';

/**
 * Validating Message for Appropriate reply
 * You can Edit you messages and Replies Here
 */
if(preg_match('[time|current time|now]', strtolower($message))) {
    // Make request to Time API
    $time = date('g : i A');
    $message_to_reply = "The Time is ".$time;
} elseif(preg_match('[hi|hello|Hey]', strtolower($message))) {
    $message_to_reply = 'Hello! How are you doing?';
} elseif(preg_match('[good|fine|cool]', strtolower($message))) {
  $message_to_reply = "Great! I can help you with time. Please make a request.";
} elseif(preg_match('[thanks|thank you]', strtolower($message))) {
  $message_to_reply = "You are welcome!";
} elseif(preg_match('[see yah|bye]', strtolower($message))) {
  $message_to_reply = "Bye too. Hope to Chat with you again! :D";
} else {
  $message_to_reply = "Huh! How do you mean?";
}

// Api URL

$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;


//Initiating cURL.
$ch = curl_init($url);

//The JSON data.
$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
    },
    "message":{
        "text":"'.$message_to_reply.'"
    }
}';

//Encoding array
$jsonDataEncoded = $jsonData;

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

//Execute the request
if(!empty($input['entry'][0]['messaging'][0]['message'])){
    $result = curl_exec($ch);
}
