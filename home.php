<?php
session_start();
include_once(__DIR__ . "/classes/User.php");

if (isset($_SESSION['id'])) {
    $user1 = new User();
    $fetch_data = $user1->fetchUserData();

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

    HIER KOMEN DE USER MATCHES 
<?php
}
else {
?> 
    <h1>sessie niet gemaakt</h1>
<?php
}

?>
<?php
$user1->matchUser();
?>
</body>
</html>