<?php
include_once(__DIR__ . "/classes/User.php");
$user1 = new User();
$user1->setFirstname("Yaiza");
echo $user1->getFirstname();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="loginForm">
        <h1>Create account</h1>
        <form action="" method="post" class="">
        <label for="firstName" class="label">First name</label>
            <input type="text" name="firstName" id="firstName" class="textfield">
            <br>
            <label for="lastName" class="label">Last name</label>
            <input type="text" name="lastName" id="lastName" class="textfield">
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