<?php


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

            <label for="fullName" class="label">Full name</label>
            <input type="text" name="fullName" id="fullName" class="textfield">

            <label for="password" class="label">Password</label>
            <input type="text" name="password" id="password" class="textfield">
        
            <input type="submit" id="submit">
        </form>
    </div>
    
    
</body>
</html>