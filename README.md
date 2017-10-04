# Timedroid
A facebook messenger bot that tells what exactly the time is.
More Feature like Setting of Reminder  are coming soon.

* Getting Started
Clone this repository
Upload index.php in the bot server, get access_token, verify_token and save.

* Setting up Bot;
The bot being a timebot does not mean it functionality cannot be changer. To edit reply and messenger in your chat bot, delete the following from the index.php file in the bot script:
```php
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
```

Replace it with:
```php
		if($message = "Hello") {
				// Make request to Time API
				$message_to_reply = "Hi"; // Reply form Bot
		} else {
			$message_to_reply = "Huh! How do you mean?"; // Bot reply this if it does not understant user's message
		}
```

For a More Functionality, you can add the elseif() block. Regex Express are also Allowed
Please do not forget to star this repository
