<?php
session_start();
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Buddy.php");
$buddy = new Buddy();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $buddy = new Buddy();
       
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
    <title>Home</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://use.typekit.net/yvr7fmc.css">
</head>
<body>
    <?php 
    if (isset($_SESSION['id'])) {
        $user = new User();
        $fetch_data = $user->fetchUserData();
      
?>
<div class="navbar">
    <ul>
    <span class="welkom"><img src="<?php User::getAvatar(); ?>" alt="Uw avatar" height="20px"/> Welkom <?php echo $_SESSION['first_name']; ?></span>
        <li><a href="profile.php">My profile</a></li><li><a href="logout.php">Log out</a></li>
</ul>
</div>
<div id="register--page">
<div class="container--page">

Welcome <b><?php echo $_SESSION['first_name']; ?></b>, You have successfully logged in!<br>
    Your bio is: <?php echo $_SESSION['bio']; ?> <br>
    Click to <a href="./logout.php" class="logout-button">Logout</a>
<h2>This are all the IMD-buddies:</h2>
<?php   
 $buddy = new Buddy();
 $buddy->getAllBuddies();
?>
----------------------------------------------------------- <br>
<h2>This is your buddy status</h2>
        <?php
        echo $buddy->checkBuddyRequest();
?>
<br>
----------------------------------------------------------- <br>
<h2>The best match for you is    
<?php
$user->fetchMatchFirstName();
?>
<h3>Because you have 
<?php
$user->matchUserAantal();
?>
 interests in common </h3>
 </h2>
 <form action="" method="post">
            <button type="submit" name="buddyRequest" value="<?php echo $user->matchUserId();?>">Send buddy request to <?php
echo $user->fetchMatchFirstName();
?></button>
</form>

<?php
}
else {
?> 
<div class="navbar">
    <ul>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Log in</a></li>
    </ul>
</div>
<div id="register--page">
<div class="container--page">
    <h1>U bent niet ingelogd</h1><br>Click to <a href="./login.php" class="logout-button">Login</a>
<?php
}
?>

</div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
<script src="./js/app.js"></script>
</body>
</html>