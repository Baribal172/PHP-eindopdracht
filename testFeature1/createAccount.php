<?php

    //$user = new CreateAccount();
    // include_once('config.php'); // connection to database

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        header ("location: index.php"); // vermoedelijk na account aanmaken
                                        // meteen naar index.php
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // check if email is empty
        if (empty(trim($_POST["email"]))) {
            $usernameError = "Please enter username!";
        } else {
            $username = trim($_POST["email"]);
        }

        // check if full name is empty
        if (empty(trim($_POST["fullName"]))) {
            $fullNameError = "Please enter full name!";
        } else {
            $fullName = trim($_POST["fullName"]);
        }

        // check if password is empty
        if (empty(trim($_POST["password"]))) {
            $passwordError = "Please enter password!";
        } else {
            $password = trim($_POST["password"]);
        }

        // als er waarden zitten in email, fullName en password
        // (als deze velden zijn ingevuld)
        if (!empty($email) && !empty($fullName) && !empty($password)) {
            $conn = new PDO('mysql:host=localhost;dbname=buddyapptest', "root", "");
            $statement = $conn->prepare("instert into users (user_id, email, fullName, password) values (:user_id, :email, :fullName, :password)");
        
            $statement->bindValue(':user_id', $userId); // sql-injectie onschadelijk/onmogelijk maken
            $statement->bindValue(':email', $email);
            $statement->bindValue(':fullName', $fullName);
            $statement->bindValue(':password', $password);

            $statement->execute(); 
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create account</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="loginForm">
        <h1>Create account</h1>
        <form action="POST">
            <label for="email" class="label">E-mail</label>
            <input type="text" name="email" id="email" class="textfield">
            <br>
            <label for="fullName" class="label">Full name</label>
            <input type="text" name="fullName" id="fullName" class="textfield">
            <br>
            <label for="password" class="label">Password</label>
            <input type="text" name="password" id="password" class="textfield">
            <br>
            <input type="submit" id="submit">
        </form>
    </div>
    
    
</body>
</html>