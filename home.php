<?php
session_start();
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Buddy.php");


if (isset($_SESSION['id'])) {
    $user1 = new User();
    $fetch_data = $user1->fetchUserData();
    $conn = Db::getConnection();
    $statement = $conn->prepare("SELECT u1.first_name,u2.first_name
    FROM (Buddy LEFT OUTER JOIN Users AS u1 ON Buddy.user_one_id = u1.id)
    LEFT OUTER JOIN Users AS u2 ON Buddy.user_two_id = u2.id
    WHERE STATUS = '0'");
    //dont forget to change status to 1, when there are buddies
    $statement->execute();
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
Welcome <b><?php echo $_SESSION['first_name']; ?></b>, You have successfully logged in!<br>
    Your bio is: <?php echo $_SESSION['bio']; ?> <br>
    Click to <a href="./logout.php" class="logout-button">Logout</a>
<?php
}
else {
?> 
    <h1>sessie niet gemaakt</h1>
<?php
}
?>
<h2>This are all the IMD-buddies:</h2>
<?php 
        while($row = $statement->fetch()) {?>
        <h4><?php echo $row[0]." and ".$row[1]?></h4>
        <?php } ?>
        <?php
        //   echo Buddy::getBuddyStatus();
        // if(Buddy::getBuddyActionUserId() == $_SESSION['id'] || Buddy::getBuddyStatus() == '0'){
        //     echo "je wacht op een antwoord van de buddy";
        // }
?>


</body>
</html>