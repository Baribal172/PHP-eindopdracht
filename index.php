<?php
include_once(__DIR__ . "/classes/User.php");
$user1 = new User();
$user1->showNumbers();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMD-Buddy</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="navbar">
    <ul>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Log in</a></li>
    </ul>
</div>
<div id="index--page">

<div class="backgroundContent">
        <img src="images/mockup.png" alt="mockup">
    </div>
<div id="loginForm">

    <h1>GO BUD</h1>

    <div class="desc--index">Dit is de IMD-Buddy app. <br><br>Dankzij deze app kun je een buddy zoeken die je tijdens je studies in IMD zal kunnen helpen, of jezelf als buddy voorstellen.<br><br>
    Momenteel hebben wij <span class="numbers"><?php echo $_SERVER['usernumber'];  ?></span> gebruikers en <span class="numbers"><?php echo $_SERVER['matchnumber'];  ?></span> matches.
    <br><br></div>
    <a href="register.php" class="button">REGISTREER</a>

</div>
</div>
</body>

</html>