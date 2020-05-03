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
    <h1>Account aangemaakt maar U bent niet ingelogd</h1><br>Click to <a href="./login.php" class="logout-button">Login</a>
<?php
}

?>
<h2>The best match for you is    
<?php
$user1->fetchMatchFirstName();
?>
<h3>Because you have 
<?php
$user1->matchUserAantal();
?>
 interests in common </h3>
 </h2>
</body>
</html>