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
</head>

<body>
    <h1>welkom</h1>
    Dit is de IMD-Buddy app. <br>
    Momenteel hebben wij <?php echo $_SERVER['usernumber'];  ?> gebruikers en <?php echo $_SERVER['matchnumber'];  ?> matches.
</body>

</html>