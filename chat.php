<?php
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Buddy.php");
include_once(__DIR__ . "/classes/Chat.php");

session_start();
    $chat = new Chat();
    $buddy = new Buddy(); 
    $buddyId = $buddy->getBuddy();
    $relationId = $buddy->getRelationId();
    $reciever = $buddy->getBuddy();

    $sender = $_SESSION['id'];
    $reciever = $reciever['id'];
    $relationId = $relationId['id'];
    
    $chat->setBuddyId($relationId);
    $chat->setSender($sender);
    $chat->setReciever($reciever);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];
    $time = new Datetime();
    $timestamp = $time->format('h:i:s d-m-y');
    $chat->setTimestamp($timestamp);
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
<div class="chatbox">

<?php     $chat->getConversation(); 
?>
</div>

<form action=""method ="POST">
	 <div><input type="text" name="message" /><input type="submit" value="Send message" name="send" /></div>
</form>
</body>
</html>