<?php
include_once(__DIR__ . "/classes/Verify.php");

$verify = new Verify;
$email = $verify->setEmail($_GET['email']);
$getEmail = $verify->getEmail();
$hash = $verify->setHash($_GET['hash']);
$getHash = $verify->getHash();

$verify->verifyEmail();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://use.typekit.net/yvr7fmc.css">
    <title>Verify your account</title>
</head>
<body><div class="navbar">
    <ul>
        <li><a href="login.php">Log in</a></li>
    </ul>
</div>
<div id="register--page">
<div class="container--page">
    
</div>
</div>
</body>
</html>