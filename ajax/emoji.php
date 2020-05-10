<?php
include_once(__DIR__. "./../classes/Chat.php");
session_start();

$chat = new Chat();
if(isset($_POST['res'])){
    $chat->setEmoji($_POST['res']);
    $chat->setId(($_POST['id']));
    $chat->saveEmoji();
}
else{
    echo "niet doorgegeven";
}
?>