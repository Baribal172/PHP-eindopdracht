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
    $buddy->sendBuddyRequest();
}
 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://use.typekit.net/yvr7fmc.css">
    </head>
    <body>
    <?php
        include_once("nav.php");
?>
        <form class="mx-auto" action="" method="GET">
            <input type="text" name="query"/>
            <input class="btn btn-primary" type="submit" value="search"/>
        </form>
        <?php  if(isset($_GET['query'])){
       $buddy->searchBuddy();
}?>
        </body>
</html>