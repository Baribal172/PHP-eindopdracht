<?php
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Buddy.php");
include_once(__DIR__ . "/classes/Chat.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chat = new Chat();
    $buddy = new Buddy();
   
    $sender = $_SESSION['id'];

    $buddyId = $buddy->getBuddy();
    $reciever = $buddyId['id'];

    $message = $_POST['message'];
    $time = new Datetime();
    $timestamp = date('h:i:s d-m-y');
    echo $timestamp;
    $chat->setTimestamp($timestamp);
    $chat->setSender($sender);
    $chat->setReciever($reciever);
    $chat->setMessage($message);
    
    $chat->addMessage();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbox</title>
</head>
<body>
<form action=""method ="POST">
	 <div><input type="text" name="message" /><input type="submit" value="message" name="send" /></div>
</form>
</body>
</html>