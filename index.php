<?php
  $access_token = "EAAUS4FywHh0BAJU8wmWRNOF1u6TPcZB2ZAGOHjO5OPD7HGwoFNkxvqLTrLYyQVnJNLlX7VbKmRq1Xl8ckcPuM4mWISNQQ85iZB2L6hbtxIcw9uIXQG2OBxKbyi4MKvFD92Es9Q81InrtU7plTeHlTVq23IjSefLpiA8WRZCyYQZDZD" // Access token from your facebook app
  $verify_token = "time2017bot" // Verify token declared by you
  $hub_verify_token = null; // Comment is comming

  if($isset($_REQUEST['hub_mode']) && ($_REQUEST['hub_mode'] == 'subscribe')) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verifu_token'];
    if($hub_verify_token === $verify_token) {
      header("HTTP/1.1 200 OK");
      echo $challenge;
      die;
    }
  }
$firstmessage = "Hello! I am Timedroid, a bot that can tell what the time is.";

$input = json_decode(file_get_contents("php://input"), true);

$sender = $input["entry"][0]["messageing"][0]["sender"]["id"];
$message = isset($input["entry"][0]["messaging"][0]["message"]["text"]) ? $input['entry'][0]["messaging"][0]["message"]["text"] : '';

if($message) {
  if($message = "") {
    $message_to_reply = $firstmessage;
  } elseif(($message = "Hi!") || ($message = "Hello") || ($message = "How far") || ($message == "Hi!") || ($message = "Hello!") || ($message = "How far?")) {
    $message_to_reply = "Hi! How can I help you?";
  } elseif(($message = "Good Morning") || ($message = "Good Afternoon") || ($message == "Good Evening")) {
    $message_to_reply = "Hello! How can I help you";
  } elseif(($message = "I want to know the time") || ($message = "What is the time?") || ($message = "What is the time") || ($message = "What time is it?") || ($message = "What time is it") || ($message = "What says the time?") || ($message = "What says the time")) {
    $time = date(T);
    $message_to_reply = "The time is ".$time;
  } elseif(($message = "Okay") || ($message = "Thanks") || ($message = "Okay. Thanks") || ($message = "Thank you") || ($message == "Okay. Thank you")) {
    $message_to_reply = "You are welcome. :D";
  } elseif(($message = "Bye") || ($message = "Bye Bye") || ($message = "Good Bye")) {
    $message_to_reply = "Bye too. Hope to chat with you again. :D";
  } elseif(($message = "help") || ($message = "Help me") || ($message = "Please help")) {
    $message_to_reply = "Hello, this is a special help note from me, Timedroid Bot \n I am a <a href=\"http://www.facebook.com/JudeTheGenius\">JudeTheGenius's</a> first php chatbot and I am 10hours years old. I was built to help you with current time. \n For you to enjoy my service, kindly follow the below Chat pattern. \n Send 'Hello' or 'Hi' or 'How far' to start chat with me. \n Send 'I want to know the time' or 'What time is it' or 'What is the time' to get the present time. \n I am still under construction. My Developer is working hard to make me chat better with you.";
  } elseif(($message = "Who are you?") || ($message = "Who are you") || ($message = "Introduce yourself") || ($message = "Can I know you?") || ($message = "Can I know you") ($message = "What do you do?") || ($message = "What can you do?") || ($message = "What can you do") || ($message = "What do you do")) {
    $message_to_reply = "I am Timedroid. I can help you with current time.";
  } else {
    $message_to_reply = "I don't seem to understand your message. \n You can send \"Help\" to see my chat pattern. <a href=''>JudeTheGenius</a> is working to make me chat better.";
  }
  $url = "https://graph.facebook.com/v2.6/me/messages?access_token=".$access_token;
  $jsonData = '{
                  "recipient" : {
                              "id" : "'.$sender.'"
                  }
                  "message" : {
                              "text": "'.$message_to_reply'"
                  }
                }';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close;
}
?>
