<?php
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Buddy.php");

session_start();
$buddy = new Buddy();



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userOne = $_SESSION['id'];
    $userTwo = $_POST['buddyRequest'];  
    $buddy->setUser_one($userOne);
    $buddy->setUser_two($userTwo);
    echo $userOne;
    echo $userTwo;
    $buddy->sendBuddyRequest();
}
 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search</title>
    </head>
    <body>
        <form action="" method="GET">
            <input type="text" name="query"/>
            <input type="submit" value="search"/>
        </form>
        <?php  if(isset($_GET['query'])){
       $buddy->searchBuddy();
}?>
        </body>
</html>