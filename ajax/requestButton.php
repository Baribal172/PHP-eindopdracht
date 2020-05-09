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
                $buddy->declineRequest();
                $conn = Db::getConnection();
                $statement = $conn->prepare("UPDATE Buddy set declineReason = :declineReason WHERE user_two_id = '".$_SESSION['id']."';");
                $statement->bindValue(":declineReason", $_POST['reason']);
                $statement->execute();
                break;
        }
    }
    if(isset($_POST['delete'])){
        echo $buddy->deleteRequest();
    }
?>