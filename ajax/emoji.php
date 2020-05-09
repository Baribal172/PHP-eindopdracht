<?php
include_once(__DIR__ . "./../classes/User.php");
include_once(__DIR__ . "./../classes/Buddy.php");
include_once(__DIR__. "./../classes/Chat.php");
session_start();

if(isset($_POST['res'])){
    echo $_POST['res'];
}
else{
    echo "niet doorgegeven";
}
?>