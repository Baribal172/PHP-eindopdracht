<?php
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Buddy.php");
include_once(__DIR__ . "/classes/chat.php");

session_start();


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbox</title>
</head>
<body>
<form action="">
	 <div><input type="text" name="message" /><input type="submit" value="Send Message" name="send" /></div>
</form>
</body>
</html>