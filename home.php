<?php
session_start();
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Buddy.php");
$buddy = new Buddy();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //    echo $_POST['buddyRequest'];
       $buddy = new Buddy();
       
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
    <title>Home</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://use.typekit.net/yvr7fmc.css">
</head>
<body>
    <?php 
    if (isset($_SESSION['id'])) {
        $user1 = new User();
        $fetch_data = $user1->fetchUserData();
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT u1.first_name,u2.first_name
        FROM (Buddy LEFT OUTER JOIN Users AS u1 ON Buddy.user_one_id = u1.id)
        LEFT OUTER JOIN Users AS u2 ON Buddy.user_two_id = u2.id
        WHERE STATUS = '1'");
        //dont forget to change status to 1, when there are buddies
        $statement->execute();
?>
    <div class="navbar">
    <ul>
        <span class="welkom">Welkom <?php echo $_SESSION['first_name']; ?> <?php echo $_SESSION['last_name']; ?></span>
        <li><a href="#">Mijn profiel</a></li> <img src="<?php echo User::getAvatar(); ?>" alt="Uw avatar" height="20px"/>

    </ul>
</div>
<div id="register--page">
<div class="container--page">

Welcome <b><?php echo $_SESSION['first_name']; ?></b>, You have successfully logged in!<br>
    Your bio is: <?php echo $_SESSION['bio']; ?> <br>
    Click to <a href="./logout.php" class="logout-button">Logout</a>
<h2>This are all the IMD-buddies:</h2>
<?php 
        while($row = $statement->fetch()) {?>
        <h4><?php echo $row[0]." and ".$row[1]?></h4>
        <?php } ?>
----------------------------------------------------------- <br>
<h2>This is your buddy status</h2>
        <?php
        echo $buddy->checkBuddyRequest();
?>
<br>
----------------------------------------------------------- <br>
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
 <form action="" method="post">
            <button type="submit" name="buddyRequest" value="<?php echo $user1->matchUserId();?>">Send buddy request to <?php
echo $user1->fetchMatchFirstName();
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
<script src="app.js"></script>
</body>
</html>