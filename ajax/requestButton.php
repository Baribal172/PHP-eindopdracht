<?php
include_once(__DIR__ . "./../classes/User.php");
include_once(__DIR__ . "./../classes/Buddy.php");

$buddy = new Buddy();
session_start();


    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'accept':
                $buddy->acceptRequest();
                break;
            case 'decline':
                $buddy->setReason($_POST['reason']);
                $buddy->declineRequest();
                break;
        }
     }
    if(isset($_POST['delete'])){
        echo $buddy->deleteRequest();
    }
?>