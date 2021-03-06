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
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://use.typekit.net/yvr7fmc.css">
    <title>Chatbox</title>
</head>
<body>
<?php
        include_once("nav.php");
?>
 
<div class="container">

<?php $chat->getConversation(); 
?>



<form action=""method ="POST">
	 <div><input class="form-control-sm"type="text" name="message" /><input class="btn-primary" type="submit" value="Send message" name="send" /></div>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
<script src="./js/app.js"></script>
</body>
</html>