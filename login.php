<?php
include_once(__DIR__ . "/classes/User.php");
$user1 = new User();
$user1->setFirstname($_POST['firstName']);
$user1->setLastname($_POST['lastName']);
$user1->setEmail($_POST['email']);
$user1->setPassword($_POST['password']);

$user1->registerUser();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="loginForm">
        <h1>Create account</h1>
        <form action="" method="post" class="">
        <label for="firstName" class="label">First name</label>
            <input type="text" name="firstName" id="firstname" class="textfield">
            <br>
            <label for="lastName" class="label">Last name</label>
            <input type="text" name="lastName" id="lastname" class="textfield">
            <br>
            <label for="email" class="label">E-mail</label>
            <input type="text" name="email" id="email" class="textfield">
            <br>
            <label for="password" class="label">Password</label>
            <input type="text" name="password" id="password" class="textfield">
            <br>
            <input type="submit" id="submit">
        </form>
    </div>
</body>
</html>